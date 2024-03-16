<title>Players Rule | LuxidDream</title>

@extends('admin/layouts/Layout')

@section('Content')

    <!-- START HEADER -->
    <div class="relative w-[100%] bg-[#dbcae8] p-6 max-md:px-3 mb-6 shadow-md">
        <div class="flex relative">
            <div class="flex items-center whitespace-nowrap text-2xl text-gray-700 font-medium gap-2 overflow-hidden">
                <i class='bx bxs-user-account text-3xl'></i>
                <span class="">จัดการกฎผู้เล่น</span>
            </div>

            <button id="btn-player-rule-add" class="flex items-center ml-auto mr-0 whitespace-nowrap h-full bg-[#8388d1] hover:bg-[#6c6ac1] rounded px-2 py-1.5 text-white font-medium duration-300">
                <i class='bx bx-plus text-2xl'></i>
                <span>เพิ่มกฎ</span>
            </button>
        </div>
    </div>
    <!-- END HEADER -->

    <!-- START CONTENT -->
    <div class="mx-6 relative">
        <div class="overflow-x-auto rounded">
            <table class="w-full text-left text-gray-500 border max-md:hidden">
                <thead class="text-gray-700 bg-gray-50 whitespace-nowrap">
                    <tr>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            #
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            จำนวนผู้เล่น
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            จำนวนวงฝัน
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            วงจรความฝัน
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            การกระทำ
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-500">
                    @if(sizeof($players_rule))
                        @foreach($players_rule as $key => $player_rule)
                            <tr class="bg-white border-b font-light whitespace-nowrap text-center">
                                <td scope="row" class="px-2 py-2">
                                    {{ $key + 1 }}
                                </td>
                                <td scope="row" class="px-2 py-2">
                                    {{ $player_rule['amount'] }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ $player_rule['circle'] }}
                                </td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center justify-center flex-col">
                                        <p>วง 5 ฝัน {{ $player_rule['nightmare_5'] }} วง</p>
                                        <p>วง 6 ฝัน {{ $player_rule['nightmare_6'] }} วง</p>
                                    </div>
                                </td>
                                <td class="px-3 py-2 text-2xl whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-3">
                                        <button class="btn-player-rule-edit hover:text-blue-700 duration-300"
                                        data-player_rule_id="{{ $player_rule['player_rule_id'] }}" data-amount="{{ $player_rule['amount'] }}" 
                                        data-circle="{{ $player_rule['circle'] }}"data-nightmare_5="{{ $player_rule['nightmare_5'] }}" data-nightmare_6="{{ $player_rule['nightmare_6'] }}">
                                            <i class='bx bx-edit' ></i>
                                        </button>

                                        <button class="btn-player-rule-delete hover:text-rose-700 duration-300" 
                                        data-route="{{ Route('SubmitPlayerRuleDelete') }}" data-player_rule_id="{{ $player_rule['player_rule_id'] }}" data-amount="{{ $player_rule['amount'] }}">
                                            <i class='bx bx-trash' ></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="bg-white border-b font-light whitespace-nowrap text-center">
                            <td scope="row" colspan="7" class="px-6 py-4 whitespace-nowrap text-center">
                                <p class="text-center text-gray-500 font-light">ไม่พบข้อมูล</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
    
            <!-- START MOBILE -->
            @if(sizeof($players_rule))
                <div class="hidden max-md:block min-w-[250px] bg-white p-4 rounded-t-2xl overflow-hidden">
                    @foreach($players_rule as $key => $player_rule)
                        <div class="flex items-center relative">
                            <div class="absolute top-0 right-0 bg-gray-200 rounded-full px-2 text-gray-500 text-sm"># {{ $key + 1 }}</div>
                            <div class="flex-col">
                                <p class="text-sm font-medium text-gray-500 truncate">
                                    จำนวนผู้เล่น: <span class="font-light">{{ $player_rule['amount']  }}</span>
                                </p>
                                <p class="text-sm font-medium text-gray-500 truncate">
                                    จำนวนวงฝัน: <span class="font-light">{{ $player_rule['circle'] }}</span>
                                </p>
                                <p class="text-sm font-medium text-gray-500 inline-flex">
                                    จำนวนวงฝัน:&nbsp;<span class="font-light">5 = {{ $player_rule['nightmare_5'] }}, 6 = {{ $player_rule['nightmare_6'] }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-1 mt-2">
                            <button class="btn-player-rule-edit flex items-center justify-center gap-1 bg-blue-500 hover:bg-blue-600 text-white text-sm px-2 py-1 rounded-3xl truncate duration-300" 
                            data-player_rule_id="{{ $player_rule['player_rule_id'] }}" data-amount="{{ $player_rule['amount'] }}" 
                            data-circle="{{ $player_rule['circle'] }}"data-nightmare_5="{{ $player_rule['nightmare_5'] }}" data-nightmare_6="{{ $player_rule['nightmare_6'] }}">
                            <i class='bx bx-edit' ></i>แก้ไข</button>

                            <button class="btn-player-rule-delete flex items-center justify-center gap-1 bg-red-500 hover:bg-red-600 text-white text-sm px-2 py-1 rounded-3xl truncate duration-300" 
                            data-route="{{ Route('SubmitPlayerRuleDelete') }}" data-player_rule_id="{{ $player_rule['player_rule_id'] }}" data-amount="{{ $player_rule['amount'] }}">
                            <i class='bx bx-trash' ></i>ลบ</button>
                        </div>
                        <hr class="bg-blue-300 border-dashed border-gray-300 w-full my-2 rounded-2xl ">
                    @endforeach
                </div>
            @else
                <div class="hidden max-md:block bg-white p-4 rounded-2xl">
                    <p class="text-center text-gray-500 font-light">ไม่พบข้อมูล</p>
                </div>
            @endif
            <!-- START MOBILE -->

        </div>
        
    </div>
    <!-- END CONTENT -->


    <!-- START MODAL PLAYER RULE ADD -->
    <div id="modal-player-rule-add" class="modal hidden z-[100] fixed flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content relative bg-white m-auto p-[20px] rounded-md max-sm:w-[100%] overflow-hidden">
            <div class="flex items-center">
                <p class="text-xl font-bold w-full ml-4 text-center whitespace-nowrap">เพิ่มกฎผู้เล่น</p>
                <span id="icon-player-rule-add-close" class="text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
            </div>
            <hr class="mt-4">
            <div class="mt-2">
                <form action="#!" method="post" onsubmit="return false;" class="m-0"
                id="form-player-rule-add" data-route="{{ Route('SubmitPlayerRuleAdd') }}">
                    <div class="grid gap-6 mb-6 grid-cols-2">
                        <div class="max-sm:col-span-2">
                            <label for="player_rule_amount_add" class="block mb-2 text-md font-medium text-gray-700 whitespace-nowrap">จำนวนผู้เล่น</label>
                            <select id="player_rule_amount_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option selected value="4" class="font-light">4</option>
                                <option value="5" class="font-light">5</option>
                                <option value="6" class="font-light">6</option>
                                <option value="7" class="font-light">7</option>
                                <option value="8" class="font-light">8</option>
                            </select>
                        </div>

                        <div class="max-sm:col-span-2">
                            <label for="player_rule_circle_add" class="block mb-2 text-md font-medium text-gray-700">จำนวนวงฝัน</label>
                            <input type="text" id="player_rule_circle_add" class="bg-gray-200 border border-gray-300 text-gray-700 text-md font-light rounded-lg block w-full p-2 outline-none" value="2" readonly>
                        </div>

                        <div class="col-span-2">
                            <label for="time" class="block mb-2 text-md font-medium text-gray-700">จำนวนวงจรความฝัน</label>
                            <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                                <div class="relative">
                                    <label for="nightmare_5_add" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">วง 5 ฝัน</label>
                                    <select id="nightmare_5_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="0" class="font-light">0</option>
                                        <option selected value="1" class="font-light">1</option>
                                        <option value="2" class="font-light">2</option>
                                        <option value="3" class="font-light">3</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="nightmare_6_add" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">วง 6 ฝัน</label>
                                    <select id="nightmare_6_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="0" class="font-light">0</option>
                                        <option selected value="1" class="font-light">1</option>
                                        <option value="2" class="font-light">2</option>
                                        <option value="3" class="font-light">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-1 mt-3">
                    <button type="submit" onClick={SubmitPlayerRuleAdd()} class="w-full text-md font-medium text-white text-center bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL PLAYER RULE ADD -->
    
    <!-- START MODAL PLAYER RULE EDIT -->
    <div id="modal-player-rule-edit" class="modal hidden z-[100] fixed flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content relative bg-white m-auto p-[20px] rounded-md max-sm:w-[100%] overflow-hidden">
            <div class="flex items-center">
                <p class="text-xl font-bold w-full ml-4 text-center whitespace-nowrap">แก้ไขกฎผู้เล่น</p>
                <span id="icon-player-rule-edit-close" class="text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
            </div>
            <hr class="mt-4">
            <div class="mt-2">
                <form action="#!" method="post" onsubmit="return false;" class="m-0"
                id="form-player-rule-edit" data-route="{{ Route('SubmitPlayerRuleEdit') }}">
                    <input id="player_rule_id_edit" type="hidden">
                    <div class="grid gap-6 mb-6 grid-cols-2">
                        <div class="max-sm:col-span-2">
                            <label for="amount_edit" class="block mb-2 text-md font-medium text-gray-700 whitespace-nowrap">จำนวนผู้เล่น</label>
                            <select id="amount_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option selected value="4" class="font-light">4</option>
                                <option value="5" class="font-light">5</option>
                                <option value="6" class="font-light">6</option>
                                <option value="7" class="font-light">7</option>
                                <option value="8" class="font-light">8</option>
                            </select>
                        </div>

                        <div class="max-sm:col-span-2">
                            <label for="circle_edit" class="block mb-2 text-md font-medium text-gray-700">จำนวนวงฝัน</label>
                            <input type="text" id="circle_edit" class="bg-gray-200 border border-gray-300 text-gray-700 text-md font-light rounded-lg block w-full p-2 outline-none" value="2" readonly>
                        </div>

                        <div class="col-span-2">
                            <label for="time" class="block mb-2 text-md font-medium text-gray-700">จำนวนวงจรความฝัน</label>
                            <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                                <div class="relative">
                                    <label for="nightmare_5_edit" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">วง 5 ฝัน</label>
                                    <select id="nightmare_5_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="0" class="font-light">0</option>
                                        <option selected value="1" class="font-light">1</option>
                                        <option value="2" class="font-light">2</option>
                                        <option value="3" class="font-light">3</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="nightmare_6_edit" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">วง 6 ฝัน</label>
                                    <select id="nightmare_6_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="0" class="font-light">0</option>
                                        <option selected value="1" class="font-light">1</option>
                                        <option value="2" class="font-light">2</option>
                                        <option value="3" class="font-light">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-1 mt-3">
                    <button type="submit" onClick={SubmitPlayerRuleEdit()} class="w-full text-md font-medium text-white text-center bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL PLAYER RULE EDIT -->

@endsection

@push('script')
    <script src="{{ secure_asset('js/admin/PlayersRule.js') }}" defer></script>
@endpush