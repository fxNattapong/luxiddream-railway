<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use App\Models\Players;
use App\Models\Players_Stats;
use App\Models\Players_Rule;
use App\Models\Levels;
use App\Models\Nightmares;
use App\Models\Links;
use App\Models\Cards;
use App\Models\Rooms;
use App\Models\Rooms_Players;
use App\Models\Rooms_Cards;

class AdminController extends Controller
{
    public function IndexRedirect() {
        if(Session::get('player_id')) {
            return redirect()->route('Players');
        } else {
            return redirect()->route('Home');
        }
    }

    public function FetchAccountData(Request $request) {
        $username = ($request->has('username')) ? trim($request->input('username')) : null;

        // $player = Players::leftJoin('players_stats', 'players.player_id', '=', 'players_stats.player_id')
        //                     ->where('players.username', $username)
        //                     ->select('players.*', 'players_stats.played_all as played_all', 'players_stats.played_last as played_last')
        //                     ->first();
        $player = Players::where('username', $username)->first();
        
        return response()->json(['player' => $player], 200);
    }

    public function SubmitAccountEdit(Request $request) {
        $player_id = ($request->has('player_id')) ? trim($request->input('player_id')) : null;
        $password = ($request->has('password')) ? trim($request->input('password')) : null;
        $phone = ($request->has('phone')) ? trim($request->input('phone')) : null;
        $email = ($request->has('email')) ? trim($request->input('email')) : null;
        $image64 = ($request->has('image64')) ? trim($request->input('image64')) : null;
        
        if(strlen($password) < 4) {
            $status = 'รหัสผ่านขั้นต่ำ 4 ตัวอักษร';
            return response()->json(['status' => $status], 400);
        }
        if(strlen($password) < 4) {
            $status = 'รหัสผ่านขั้นต่ำ 4 ตัวอักษร';
            return response()->json(['status' => $status], 400);
        }
        if($phone && strlen($phone) < 10 || strlen($phone) > 10) {
            $status = 'รูปแบบหมายเลขโทรศัพท์ไม่ถูกต้อง';
            return response()->json(['status' => $status], 400);
        }
        if($email) {
            if (!(Str::endsWith($email, '@gmail.com') || Str::endsWith($email, '@hotmail.com') || Str::endsWith($email, '@outlook.com'))) {
                $status = 'กรุณารูปแบบอีเมลให้ถูกต้อง';
                return response()->json(['status' => $status], 400);
            }
        }

        if($image64) {
            @list($type, $file_data) = explode(';', $image64);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = Str::random(10).'.'.'png';   
            file_put_contents(config('pathImage.uploads_path') . '/' . $imageName, base64_decode($file_data));

            Players::where('player_id', $player_id)
                ->update([
                'password' => $password,
                'phone' => $phone,
                'email' => $email,
                'image' => $imageName,
                'updated_at' => now()
            ]);

            $player = Players::where('player_id', $player_id)->first();
            session::put('image', $player->image);
        } else {
            Players::where('player_id', $player_id)
                ->update([
                'password' => $password,
                'phone' => $phone,
                'email' => $email,
                'updated_at' => now()
            ]);
        }

        return response()->json(200);
    }



    public function Players(Request $request) {
        $keyword = $request->input('keyword');

        $players = Players::when($keyword, function ($query, $keyword) {
            return $query->where('username', 'like', "%$keyword%")
                        ->orWhere('phone', 'like', "%$keyword%")
                        ->orWhere('email', 'like', "%$keyword%");
        })
        ->paginate(5, ['*'], 'page');

        return view('admin/contents/Players', compact('players', 'keyword'));
    }

    public function SubmitPlayerAdd(Request $request) {
        $username = ($request->has('username')) ? trim($request->input('username')) : null;
        $password = ($request->has('password')) ? trim($request->input('password')) : null;
        $phone = ($request->has('phone')) ? trim($request->input('phone')) : null;
        $email = ($request->has('email')) ? trim($request->input('email')) : null;
        $role = ($request->has('role')) ? trim($request->input('role')) : null;
        $image64 = ($request->has('image64')) ? trim($request->input('image64')) : null;

        if(!$username) {
            $status = 'กรุณากรอกชื่อผู้ใช้';
            return response()->json(['status' => $status], 400);
        }
        if(strlen($username) < 4 || strlen($password) < 4) {
            $status = 'ชื่อผู้ใช้และรหัสผ่านขั้นต่ำ 4 ตัวอักษร';
            return response()->json(['status' => $status], 400);
        }
        if($phone && strlen($phone) < 10 || strlen($phone) > 10) {
            $status = 'รูปแบบหมายเลขโทรศัพท์ไม่ถูกต้อง';
            return response()->json(['status' => $status], 400);
        }
        if($email) {
            if (!(Str::endsWith($email, '@gmail.com') || Str::endsWith($email, '@hotmail.com') || Str::endsWith($email, '@outlook.com'))) {
                $status = 'กรุณารูปแบบอีเมลให้ถูกต้อง';
                return response()->json(['status' => $status], 400);
            }

            $isEmailAlready = Players::where('email', $email)->first();
            if($isEmailAlready) {
                $status = 'อีเมลดังกล่าวถูกใช้ไปแล้ว';
                return response()->json(['status' => $status], 400);
            }
        }

        $isUser = Players::where('username', $username)->first();
        if($isUser) {
            $status = 'ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว';
            return response()->json(['status' => $status], 400); 
        } else {
            $InsertRow = new Players;
            $InsertRow->username = $username;
            $InsertRow->password = $password;

            if($phone) {
                $InsertRow->phone = $phone;
            }
            if($email) {
                $InsertRow->email = $email;
            }

            $InsertRow->role = $role;

            if($image64) {
                @list($type, $file_data) = explode(';', $image64);
                @list(, $file_data) = explode(',', $file_data); 
                $imageName = Str::random(10).'.'.'png';   
                file_put_contents(config('pathImage.uploads_path') . '/' . $imageName, base64_decode($file_data));
                
                $InsertRow->image = $imageName;
            }
            
            $InsertRow->save();
        }
        return response()->json(200);
    }

    public function SubmitPlayerEdit(Request $request) {
        $player_id = ($request->has('player_id')) ? trim($request->input('player_id')) : null;
        $username_current = ($request->has('username_current')) ? trim($request->input('username_current')) : null;
        $username = ($request->has('username')) ? trim($request->input('username')) : null;
        $password = ($request->has('password')) ? trim($request->input('password')) : null;
        $phone = ($request->has('phone')) ? trim($request->input('phone')) : null;
        $email = ($request->has('email')) ? trim($request->input('email')) : null;
        $role = ($request->has('role')) ? trim($request->input('role')) : null;
        $image64 = ($request->has('image64')) ? trim($request->input('image64')) : null;
        
        if(strlen($password) < 4) {
            $status = 'รหัสผ่านขั้นต่ำ 4 ตัวอักษร';
            return response()->json(['status' => $status], 400);
        }
        if(strlen($password) < 4) {
            $status = 'รหัสผ่านขั้นต่ำ 4 ตัวอักษร';
            return response()->json(['status' => $status], 400);
        }
        if($phone && strlen($phone) < 10 || strlen($phone) > 10) {
            $status = 'รูปแบบหมายเลขโทรศัพท์ไม่ถูกต้อง';
            return response()->json(['status' => $status], 400);
        }
        if($email) {
            if (!(Str::endsWith($email, '@gmail.com') || Str::endsWith($email, '@hotmail.com') || Str::endsWith($email, '@outlook.com'))) {
                $status = 'กรุณารูปแบบอีเมลให้ถูกต้อง';
                return response()->json(['status' => $status], 400);
            }

            $isEmailAlready = Players::where('email', $email)->first();
            if($isEmailAlready && $isEmailAlready->player_id != $player_id) {
                $status = 'อีเมลดังกล่าวถูกใช้ไปแล้ว';
                return response()->json(['status' => $status], 400);
            }
        }
        
        if($username != $username_current) {
            $isMember = Players::where('username', $username)->first();
            if($isMember) {
                $status = 'ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว';
                return response()->json(['status' => $status], 400);
            }
        }

        if($image64) {
            @list($type, $file_data) = explode(';', $image64);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = Str::random(10).'.'.'png';   
            file_put_contents(config('pathImage.uploads_path') . '/' . $imageName, base64_decode($file_data));

            Players::where('player_id', $player_id)
                ->update([
                'username' => $username,
                'password' => $password,
                'phone' => $phone,
                'email' => $email,
                'role' => $role,
                'image' => $imageName,
                'updated_at' => now()
            ]);
        } else {
            Players::where('player_id', $player_id)
                ->update([
                'username' => $username,
                'password' => $password,
                'phone' => $phone,
                'email' => $email,
                'role' => $role,
                'updated_at' => now()
            ]);
        }

        return response()->json(200);
    }

    public function SubmitPlayerDelete(Request $request) {
        $player_id = ($request->has('player_id')) ? ($request->input('player_id')) : null;

        Players::where('player_id', $player_id)->delete();

        return response()->json(200);
    }



    public function PlayersRule(Request $request) {
        $players_rule = Players_Rule::All();

        return view('admin/contents/PlayersRule', compact('players_rule'));
    }

    public function SubmitPlayerRuleAdd(Request $request) {
        $amount = ($request->has('amount')) ? trim($request->input('amount')) : null;
        $circle = ($request->has('circle')) ? trim($request->input('circle')) : null;
        $nightmare_5 = ($request->has('nightmare_5')) ? trim($request->input('nightmare_5')) : null;
        $nightmare_6 = ($request->has('nightmare_6')) ? trim($request->input('nightmare_6')) : null;
        
        $isRule = Players_Rule::where('amount', $amount)->first();
        if($isRule) {
            $status = 'จำนวนผู้เล่นนี้ถูกสร้างแล้ว';
            return response()->json(['status' => $status], 400);
        }

        $InsertRow = new Players_Rule;
        $InsertRow->amount = $amount;
        $InsertRow->circle = $circle;
        $InsertRow->nightmare_5 = $nightmare_5;
        $InsertRow->nightmare_6 = $nightmare_6;
        $InsertRow->save();

        return response()->json(200);
    }

    public function SubmitPlayerRuleEdit(Request $request) {
        $player_rule_id = ($request->has('player_rule_id')) ? trim($request->input('player_rule_id')) : null;
        $amount = ($request->has('amount')) ? trim($request->input('amount')) : null;
        $circle = ($request->has('circle')) ? trim($request->input('circle')) : null;
        $nightmare_5 = ($request->has('nightmare_5')) ? trim($request->input('nightmare_5')) : null;
        $nightmare_6 = ($request->has('nightmare_6')) ? trim($request->input('nightmare_6')) : null;
        $isRule = Players_Rule::where('amount', $amount)->first();

        if($isRule && $isRule->player_rule_id != $player_rule_id) {
            $status = 'จำนวนผู้เล่นนี้ถูกสร้างแล้ว';
            return response()->json(['status' => $status], 400);
        }

        Players_Rule::where('player_rule_id', $player_rule_id)
                    ->update([
                        'amount' => $amount,
                        'circle' => $circle,
                        'nightmare_5' => $nightmare_5,
                        'nightmare_6' => $nightmare_6,
                        'updated_at' => now()
                    ]);

        return response()->json(200);
    }

    public function SubmitPlayerRuleDelete(Request $request) {
        $player_rule_id = ($request->has('player_rule_id')) ? ($request->input('player_rule_id')) : null;

        Players_Rule::where('player_rule_id', $player_rule_id)->delete();

        return response()->json(200);
    }



    public function Levels(Request $request) {
        $levels = Levels::All();

        return view('admin/contents/Levels', compact('levels'));
    }

    public function SubmitLevelAdd(Request $request) {
        $level = ($request->has('level')) ? trim($request->input('level')) : null;
        $round = ($request->has('round')) ? trim($request->input('round')) : null;
        $time_1 = ($request->has('time_1')) ? trim($request->input('time_1')) : null;
        $time_2 = ($request->has('time_2')) ? trim($request->input('time_2')) : null;
        $time_3 = ($request->has('time_3')) ? trim($request->input('time_3')) : null;
        $time_4 = ($request->has('time_4')) ? trim($request->input('time_4')) : null;
        $time_5 = ($request->has('time_5')) ? trim($request->input('time_5')) : null;

        $isLevel = Levels::where('level', $level)->first();
        if($isLevel) {
            $status = 'ระดับความยากนี้ถูกสร้างแล้ว';
            return response()->json(['status' => $status], 400);
        }

        $InsertRow = new Levels;
        $InsertRow->level = $level;
        $InsertRow->round = $round;
        $InsertRow->time_1 = $time_1;
        $InsertRow->time_2 = $time_2;
        $InsertRow->time_3 = $time_3;
        $InsertRow->time_4 = $time_4;
        $InsertRow->time_5 = $time_5;
        $InsertRow->save();

        return response()->json(200);
    }

    public function SubmitLevelEdit(Request $request) {
        $level_id = ($request->has('level_id')) ? trim($request->input('level_id')) : null;
        $level = ($request->has('level')) ? trim($request->input('level')) : null;
        $round = ($request->has('round')) ? trim($request->input('round')) : null;
        $time_1 = ($request->has('time_1')) ? trim($request->input('time_1')) : null;
        $time_2 = ($request->has('time_2')) ? trim($request->input('time_2')) : null;
        $time_3 = ($request->has('time_3')) ? trim($request->input('time_3')) : null;
        $time_4 = ($request->has('time_4')) ? trim($request->input('time_4')) : null;
        $time_5 = ($request->has('time_5')) ? trim($request->input('time_5')) : null;

        $isLevel = Levels::where('level', $level)->first();
        if($isLevel && ($isLevel->level_id != $level_id)) {
            $status = 'ระดับความยากนี้ถูกสร้างแล้ว';
            return response()->json(['status' => $status], 400);
        }

        Levels::where('level_id', $level_id)
                ->update([
                    'level' => $level,
                    'round' => $round,
                    'time_1' => $time_1,
                    'time_2' => $time_2,
                    'time_3' => $time_3,
                    'time_4' => $time_4,
                    'time_5' => $time_5,
                    'updated_at' => now()
                ]);

        return response()->json(200);
    }

    public function SubmitLevelDelete(Request $request) {
        $level_id = ($request->has('level_id')) ? ($request->input('level_id')) : null;

        Levels::where('level_id', $level_id)->delete();

        return response()->json(200);
    }



    public function Nightmares(Request $request) {
        $nightmares = Nightmares::orderBy('type', 'desc')->paginate(8, ['*'], 'page');

        return view('admin/contents/Nightmares', compact('nightmares'));
    }

    public function SubmitNightmareAdd(Request $request) {
        $type = ($request->has('type')) ? trim($request->input('type')) : null;
        $description = ($request->has('description')) ? trim($request->input('description')) : null;
        $image64 = ($request->has('image64')) ? trim($request->input('image64')) : null;

        $isNightmare = Nightmares::where('description', $description)->first();
        if($isNightmare) {
            $status = 'ฝันร้ายนี้ถูกสร้างแล้ว';
            return response()->json(['status' => $status], 400);
        }

        $InsertRow = new Nightmares;
        $InsertRow->type = $type;
        $InsertRow->description = $description;

        if($image64) {
            @list($type, $file_data) = explode(';', $image64);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = Str::random(10).'.'.'png';   
            file_put_contents(config('pathImage.uploads_path') . '/' . $imageName, base64_decode($file_data));
            
            $InsertRow->image = $imageName;
        }

        $InsertRow->save();

        return response()->json(200);
    }

    public function SubmitNightmareEdit(Request $request) {
        $nightmare_id = ($request->has('nightmare_id')) ? trim($request->input('nightmare_id')) : null;
        $nightmare_type = ($request->has('type')) ? trim($request->input('type')) : null;
        $description = ($request->has('description')) ? trim($request->input('description')) : null;
        $image64 = ($request->has('image64')) ? trim($request->input('image64')) : null;

        if(!$description) {
            $status = 'กรุณากรอกรายละเอียด';
            return response()->json(['status' => $status], 400);
        }

        $isNightmare = Nightmares::where('description', $description)->first();
        if($isNightmare && $isNightmare->nightmare_id != $nightmare_id) {
            $status = 'ฝันร้ายนี้ถูกสร้างแล้ว';
            return response()->json(['status' => $status], 400);
        }

        if($image64) {
            @list($type, $file_data) = explode(';', $image64);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = Str::random(10).'.'.'png';
            file_put_contents(config('pathImage.uploads_path') . '/' . $imageName, base64_decode($file_data));

            Nightmares::where('nightmare_id', $nightmare_id)
                        ->update([
                            'type' => $nightmare_type,
                            'description' => $description,
                            'image' => $imageName,
                            'updated_at' => now()
                        ]);
        } else {
            Nightmares::where('nightmare_id', $nightmare_id)
                        ->update([
                            'type' => $nightmare_type,
                            'description' => $description,
                            'updated_at' => now()
                        ]);
        }

        return response()->json(200);
    }

    public function SubmitNightmareDelete(Request $request) {
        $nightmare_id = ($request->has('nightmare_id')) ? trim($request->input('nightmare_id')) : null;

        Nightmares::where('nightmare_id', $nightmare_id)->delete();

        return response()->json(200);
    }



    public function Links(Request $request) {
        $links = Links::orderBy('type', 'desc')->paginate(8, ['*'], 'page');

        return view('admin/contents/Links', compact('links'));
    }

    public function SubmitLinkAdd(Request $request) {
        $type = ($request->has('type')) ? trim($request->input('type')) : null;
        $image64 = ($request->has('image64')) ? trim($request->input('image64')) : null;

        if(!$image64) {
            $status = 'กรุณาแนบรูปภาพ';
            return response()->json(['status' => $status], 400);
        }

        $InsertRow = new Links;
        $InsertRow->type = $type;

        if($image64) {
            @list($type, $file_data) = explode(';', $image64);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = Str::random(10).'.'.'png';   
            file_put_contents(config('pathImage.uploads_path') . '/' . $imageName, base64_decode($file_data));
            
            $InsertRow->image = $imageName;
        }

        $InsertRow->save();

        return response()->json(200);
    }

    public function SubmitLinkEdit(Request $request) {
        $link_id = ($request->has('link_id')) ? trim($request->input('link_id')) : null;
        $link_type = ($request->has('type')) ? trim($request->input('type')) : null;
        $image64 = ($request->has('image64')) ? trim($request->input('image64')) : null;
        
        if($image64) {
            @list($type, $file_data) = explode(';', $image64);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = Str::random(10).'.'.'png';
            file_put_contents(config('pathImage.uploads_path') . '/' . $imageName, base64_decode($file_data));
            
            Links::where('link_id', $link_id)
                ->update([
                    'type' => $link_type,
                    'image' => $imageName,
                    'updated_at' => now()
                ]);
        } else {
            Links::where('link_id', $link_id)
                ->update([
                    'type' => $link_type,
                    'updated_at' => now()
                ]);
        }

        return response()->json(200);
    }

    public function SubmitLinkDelete(Request $request) {
        $link_id = ($request->has('link_id')) ? trim($request->input('link_id')) : null;

        Links::where('link_id', $link_id)->delete();

        return response()->json(200);
    }



    public function Cards(Request $request) {
        $cards = Cards::paginate(8, ['*'], 'page');

        return view('admin/contents/Cards', compact('cards'));
    }

    public function SubmitCardAdd(Request $request) {
        $code = ($request->has('code')) ? trim($request->input('code')) : null;
        $color = ($request->has('color')) ? trim($request->input('color')) : null;
        $skill = ($request->has('skill')) ? trim($request->input('skill')) : null;
        $name = ($request->has('name')) ? trim($request->input('name')) : null;
        $description = ($request->has('description')) ? trim($request->input('description')) : null;
        $image64 = ($request->has('image64')) ? trim($request->input('image64')) : null;

        if(!$name) {
            $status = 'กรุณากรอกชื่อการ์ด';
            return response()->json(['status' => $status], 400);
        }
        if(!$image64) {
            $status = 'กรุณาเพิ่มรูปภาพ';
            return response()->json(['status' => $status], 400);
        }

        $isCard = Cards::where('code', $code)->first();
        if($isCard) {
            $status = 'รหัสการ์ดทักษะนี้ถูกสร้างแล้ว';
            return response()->json(['status' => $status], 400);
        }

        $InsertRow = new Cards;
        $InsertRow->code = $code;
        $InsertRow->color = $color;
        $InsertRow->skill = $skill;
        $InsertRow->name = $name;
        $InsertRow->description = $description;

        if($image64) {
            @list($type, $file_data) = explode(';', $image64);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = Str::random(10).'.'.'png';   
            file_put_contents(config('pathImage.uploads_path') . '/' . $imageName, base64_decode($file_data));
            
            $InsertRow->image = $imageName;
        }

        $InsertRow->save();

        return response()->json(200);
    }

    public function SubmitCardEdit(Request $request) {
        $card_id = ($request->has('card_id')) ? trim($request->input('card_id')) : null;
        $code = ($request->has('code')) ? trim($request->input('code')) : null;
        $color = ($request->has('color')) ? trim($request->input('color')) : null;
        $skill = ($request->has('skill')) ? trim($request->input('skill')) : null;
        $name = ($request->has('name')) ? trim($request->input('name')) : null;
        $description = ($request->has('description')) ? trim($request->input('description')) : null;
        $image64 = ($request->has('image64')) ? trim($request->input('image64')) : null;

        if(!$name) {
            $status = 'กรุณากรอกชื่อการ์ด';
            return response()->json(['status' => $status], 400);
        }

        $isCard = Cards::where('code', $code)->first();
        if($isCard && $isCard->card_id != $card_id) {
            $status = 'รหัสการ์ดทักษะนี้ถูกสร้างแล้ว';
            return response()->json(['status' => $status], 400);
        }

        if($image64) {
            @list($type, $file_data) = explode(';', $image64);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = Str::random(10).'.'.'png';
            file_put_contents(config('pathImage.uploads_path') . '/' . $imageName, base64_decode($file_data));

            Cards::where('card_id', $card_id)
                ->update([
                    'code' => $code,
                    'skill' => $skill,
                    'color' => $color,
                    'name' => $name,
                    'description' => $description,
                    'image' => $imageName,
                    'updated_at' => now()
                ]);
        } else {
            Cards::where('card_id', $card_id)
                ->update([
                    'code' => $code,
                    'skill' => $skill,
                    'color' => $color,
                    'name' => $name,
                    'description' => $description,
                    'updated_at' => now()
                ]);
        }

        return response()->json(200);
    }

    public function SubmitCardDelete(Request $request) {
        $card_id = ($request->has('card_id')) ? trim($request->input('card_id')) : null;

        Cards::where('card_id', $card_id)->delete();

        return response()->json(200);
    }
}
