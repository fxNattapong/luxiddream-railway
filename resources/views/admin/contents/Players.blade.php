<title>Players | LuxidDream</title>

@extends('admin/layouts/Layout')

@section('Content')

    <!-- START HEADER -->
    <div class="relative w-[100%] bg-[#dbcae8] p-6 max-md:px-3 mb-6 shadow-md">
        <div class="flex relative">
            <div class="flex items-center whitespace-nowrap text-2xl text-gray-700 font-medium gap-2 overflow-hidden">
                <i class="bx bxs-user-rectangle text-3xl"></i>
                <span class="">จัดการผู้เล่น</span>
            </div>

            <button id="btn-player-add" class="flex items-center ml-auto mr-0 whitespace-nowrap h-full bg-[#8388d1] hover:bg-[#6c6ac1] rounded px-2 py-1.5 text-white font-medium duration-300">
                <i class='bx bx-plus text-2xl'></i>
                <span>เพิ่มผู้เล่น</span>
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
                            รูปภาพ
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            ชื่อผู้ใช้
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            หมายเลขโทรศัพท์
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            สิทธิ์การใช้
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            การกระทำ
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-500">
                    @if(sizeof($players))
                        @foreach($players as $key => $player)
                            <tr class="bg-white border-b font-light whitespace-nowrap text-center">
                                <td scope="row" class="px-2 py-2">
                                    {{ $loop->iteration + $players->firstItem() - 1 }}
                                </td>
                                <td scope="row" class="px-2 py-2">
                                    <div class="relative bg-white w-[80px] h-[80px] p-1 overflow-hidden mx-auto border rounded-md">
                                        @if($player['image'])
                                            <img src="{{ URL('/uploads/'.$player['image']) }}" alt="" class="w-full h-full object-cover my-auto" alt="player_image">
                                        @else
                                            <img src="{{ URL('/assets/member.png') }}" alt="" class="w-full h-full object-cover my-auto" alt="player_image">
                                        @endif
                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    {{ $player['username'] }}
                                </td>
                                <td class="px-3 py-2">
                                    @if($player['phone'])
                                        {{ $player['phone'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    @if($player['role'] === 0)
                                        ผู้เล่น
                                    @else
                                        ผู้ดูแลระบบ
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-2xl whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-3">
                                        <button class="btn-player-edit hover:text-blue-700 duration-300"
                                        data-id="{{ $player['player_id'] }}" data-username="{{ $player['username'] }}" data-password="{{ $player['password'] }}" 
                                        data-phone="{{ $player['phone'] }}" data-email="{{ $player['email'] }}"  data-image="{{ isset($player['image']) ? URL('/uploads/' . $player['image']) : '' }}"
                                        data-role="{{ $player['role'] }}">
                                            <i class='bx bx-edit' ></i>
                                        </button>

                                        <button class="btn-player-delete hover:text-rose-700 duration-300" 
                                        data-route="{{ Route('SubmitPlayerDelete') }}" data-player_id="{{ $player['player_id'] }}" data-username="{{ $player['username'] }}">
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
            @if(sizeof($players))
                <div class="hidden max-md:block min-w-[250px] bg-white p-4 rounded-t-2xl overflow-hidden">
                    @foreach($players as $key => $player)
                        <div class="flex items-center relative">
                            <div class="min-w-[60px] max-w-[80px] pr-2">
                                @if($player['image'])
                                    <img src="{{ URL('/uploads/'.$player['image']) }}" alt="" class="w-full h-auto object-scale-down mx-auto rounded border p-1">
                                @else
                                    <img src="{{ URL('/assets/member.png') }}" alt="" class="w-full h-auto object-scale-down mx-auto rounded border p-1">
                                @endif
                            </div>
                            <div class="absolute top-0 right-0 bg-gray-200 rounded-full px-2 text-gray-500 text-sm"># {{ $loop->iteration + $players->firstItem() - 1 }}</div>
                            <div class="flex-col">
                                <p class="text-sm font-medium text-gray-500 truncate">ชื่อผู้ใช้: <span class="font-light">{{ $player['username'] }}</span></p>
                                <p class="text-sm font-medium text-gray-500 truncate">โทรศัพท์: 
                                    <span class="font-light">
                                        @if($player['phone'])
                                            {{ $player['phone'] }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </p>
                                <p class="text-sm font-medium text-gray-500 truncate">สิทธิ์การใช้: 
                                    <span class="font-light">
                                        @if($player['role'] === 0)
                                            ผู้เล่น
                                        @else
                                            ผู้ดูแลระบบ
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-1 mt-2">
                            <button class="btn-player-edit flex items-center justify-center gap-1 bg-blue-500 hover:bg-blue-600 text-white text-sm px-2 py-1 rounded-3xl truncate duration-300" 
                            data-id="{{ $player['player_id'] }}" data-username="{{ $player['username'] }}" data-password="{{ $player['password'] }}" 
                            data-phone="{{ $player['phone'] }}" data-email="{{ $player['email'] }}" data-image="{{ isset($player['image']) ? URL('/uploads/' . $player['image']) : '' }}"
                            data-role="{{ $player['role'] }}">
                            <i class='bx bx-edit' ></i>แก้ไข</button>
    
                            <button class="btn-player-delete flex items-center justify-center gap-1 bg-red-500 hover:bg-red-600 text-white text-sm px-2 py-1 rounded-3xl truncate duration-300" 
                            data-route="{{ Route('SubmitPlayerDelete') }}" data-player_id="{{ $player['player_id'] }}" data-username="{{ $player['username'] }}">
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
        
        {!! $players->links('pagination.Pagination') !!}
        @include('pagination.Pagination', ['data_paginate' => $players])
    </div>
    <!-- END CONTENT -->


    <!-- START MODAL PLAYER ADD -->
    <div id="modal-player-add" class="modal hidden z-[100] fixed flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content relative bg-white m-auto p-[20px] rounded-md">
            <div class="flex items-center">
                <p class="text-xl font-bold w-full ml-4 text-center">เพิ่มบัญชีผู้เล่น</p>
                <span id="icon-player-add-close" class="text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
            </div>
            <hr class="mt-4">
            <div class="mt-2">
                <form action="#!" method="post" onsubmit="return false;" class="m-0"
                id="form-player-add" data-route="{{ Route('SubmitPlayerAdd') }}">
                    <div class="grid gap-6 mb-6 grid-cols-2">
                        <div class="max-sm:col-span-2">
                            <label for="player_username_add" class="block mb-2 text-md font-medium text-gray-700">ชื่อผู้ใช้ <span class="text-red-800 text-xl">*</span></label>
                            <input type="text" id="player_username_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณาชื่อผู้ใช้" required>
                        </div>
                        <div class="relative w-full max-sm:col-span-2">
                            <label for="player_password_add" class="block mb-2 text-md font-medium text-gray-700">รหัสผ่าน <span class="text-red-800 text-xl">*</span></label>
                            <input type="text" id="player_password_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณารหัสผ่าน" required>
                        </div>
                        <div class="max-md:col-span-2">
                            <div class="inline-flex gap-2">
                                <label for="player_phone_add" class="whitespace-nowrap mb-2 text-md font-medium text-gray-700">หมายเลขโทรศัพท์</label>
                                <span class="hidden phoneLengthWarning text-sm text-rose-700 font-light mt-[2px] max-sm:mt-[3px]"></span>
                            </div>
                            <input type="text" id="player_phone_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกหมายเลขโทรศัพท์">
                        </div>
                        <div class="max-md:col-span-2">
                            <label for="player_email_add" class="block mb-2 text-md font-medium text-gray-700">อีเมล</label>
                            <input type="text" id="player_email_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกอีเมล">
                        </div>
                        <div class="max-md:col-span-2">
                            <label for="player_role_add" class="block mb-2 text-md font-medium text-gray-700">สิทธิ์การใช้</label>
                            <select id="player_role_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option selected value="0" class="font-light">ผู้เล่น</option>
                                <option value="1" class="font-light">ผู้ดูแลระบบ</option>
                            </select>
                        </div>
                        <div class="max-md:col-span-2">
                            <p class="mb-2 text-md font-medium text-gray-700">รูปภาพผู้ใช้</p>
                            <div class="flex items-center space-x-2 bg-gray-200 rounded-lg w-full">
                                <div class="shrink-0 ml-1 mt-1 mb-1 bg-white rounded-full">
                                    <img id='image_add' class="h-11 w-11 object-cover rounded-full" src="{{ URL('/assets/'.'admin.png') }}" alt="Current profile photo" />
                                </div>
                                <label class="block w-fit">
                                    <span class="sr-only">Choose profile photo</span>
                                    <input type="file" onChange={fileChosen_Single(event)} id="image_add" name="image" accept="image/png, image/jpeg" class="block w-full text-sm text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-blue-50 file:text-blue-700
                                        hover:file:bg-blue-100 duration-300
                                    "/>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-1 mt-3">
                    <button type="submit" onClick={SubmitPlayerAdd()} class="w-full text-md font-medium text-white text-center bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL PLAYER ADD -->
    
    <!-- START MODAL PLAYER EDIT -->
    <div id="modal-player-edit" class="modal hidden z-[100] fixed flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content relative bg-white m-auto p-[20px] rounded-md">
            <div class="flex items-center">
                <p class="text-[20px] font-bold w-full ml-4 text-center">แก้ไขบัญชีผู้เล่น</p>
                <span id="icon-player-edit-close" class="text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
            </div>
            <hr class="mt-4">
            <div class="mt-2">
                <form action="#!" method="post" onsubmit="return false;" class="m-0"
                id="form-player-edit" data-route="{{ Route('SubmitPlayerEdit') }}">
                    <input type="text" id="player_id_edit" class="hidden" readonly>
                    <input type="text" id="player_username_current" class="hidden" readonly>
                    <div class="grid gap-6 mb-6 grid-cols-2">
                        <div class="max-sm:col-span-2">
                            <label for="player_username_edit" class="block mb-2 text-md font-medium text-gray-700">ชื่อผู้ใช้ <span class="text-red-800 text-xl">*</span></label>
                            <input type="text" id="player_username_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณาชื่อผู้ใช้" required>
                        </div>
                        <div class="relative w-full max-sm:col-span-2">
                            <label for="player_password_edit" class="block mb-2 text-md font-medium text-gray-700">รหัสผ่าน <span class="text-red-800 text-xl">*</span></label>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 z-10 mt-9">
                                <input class="hidden js-password-toggle" type="checkbox" />
                                <label class="js-password-label bg-gray-300 hover:bg-gray-400 duration-300 rounded px-2 py-1 text-sm text-gray-600 cursor-pointer" for="toggle">แสดง</label>
                            </div>
                            <div class="relative float-label-input">
                                <input type="password" id="player_password_edit" class="js-password bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="รหัสผ่านขั้นต่ำ 4 ตัวอักษร">
                            </div>
                        </div>
                        <div class="max-md:col-span-2">
                            <div class="inline-flex gap-2">
                                <label for="player_phone_edit" class="whitespace-nowrap mb-2 text-md font-medium text-gray-700">หมายเลขโทรศัพท์</label>
                                <span class="hidden phoneLengthWarning text-sm text-rose-700 font-light mt-[2px] max-sm:mt-[3px]"></span>
                            </div>
                            <input type="text" id="player_phone_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกหมายเลขโทรศัพท์">
                        </div>
                        <div class="max-md:col-span-2">
                            <label for="player_email_edit" class="block mb-2 text-md font-medium text-gray-700">อีเมล</label>
                            <input type="text" id="player_email_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกอีเมล">
                        </div>
                        <div class="max-md:col-span-2">
                            <label for="player_role_edit" class="block mb-2 text-md font-medium text-gray-700">สิทธิ์การใช้</label>
                            <select id="player_role_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option selected value="0" class="font-light">ผู้เล่น</option>
                                <option value="1" class="font-light">ผู้ดูแลระบบ</option>
                            </select>
                        </div>
                        <div class="max-md:col-span-2">
                            <p class="mb-2 text-md font-medium text-gray-700">รูปภาพผู้ใช้</p>
                            <div class="flex items-center space-x-2 bg-gray-200 rounded-lg w-full">
                                <div class="shrink-0 ml-1 mt-1 mb-1 bg-white rounded-full">
                                    <img id='image_edit' class="h-11 w-11 object-cover rounded-full" src="{{ URL('/assets/'.'member.png') }}" alt="Current profile photo" />
                                </div>
                                <label class="block w-fit">
                                    <span class="sr-only">Choose profile photo</span>
                                    <input type="file" onChange={fileChosen_Single(event)} id="image_edit" name="image" accept="image/png, image/jpeg" class="block w-full text-sm text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-blue-50 file:text-blue-700
                                        hover:file:bg-blue-100 duration-300
                                    "/>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-1 mt-3">
                    <button type="submit" onClick={SubmitPlayerEdit()} class="w-full text-md font-medium text-white text-center bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL PLAYER EDIT -->

@endsection

@push('script')
    <script src="{{ secure_asset('js/admin/Players.js') }}" defer></script>
@endpush