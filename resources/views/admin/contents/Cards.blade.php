<title>Cards | LuxidDream</title>

@extends('admin/layouts/Layout')

@section('Content')

    <!-- START HEADER -->
    <div class="relative w-[100%] bg-[#dbcae8] p-6 max-md:px-3 mb-6 shadow-md">
        <div class="flex relative">
            <div class="flex items-center whitespace-nowrap text-2xl text-gray-700 font-medium gap-2 overflow-hidden">
                <i class='bx bx-credit-card-front text-3xl' ></i>
                <span class="">จัดการการ์ดทักษะ</span>
            </div>

            <button id="btn-card-add" class="flex items-center ml-auto mr-0 whitespace-nowrap h-full bg-[#8388d1] hover:bg-[#6c6ac1] rounded px-2 py-1.5 text-white font-medium duration-300">
                <i class='bx bx-plus text-2xl'></i>
                <span>เพิ่มการ์ด</span>
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
                            รหัส
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            ทักษะ
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            สี
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            ชื่อการ์ด
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            รายละเอียด
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            การกระทำ
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-500">
                    @if(sizeof($cards))
                        @foreach($cards as $key => $card)
                            <tr class="bg-white border-b font-light whitespace-nowrap text-center">
                                <td scope="row" class="px-2 py-2">
                                    {{ $loop->iteration + $cards->firstItem() - 1 }}
                                </td>
                                <td scope="row" class="px-2 py-2">
                                    <div class="relative bg-white w-[120px] h-[80px] p-1 overflow-hidden mx-auto border rounded-md">
                                        @if($card['image'])
                                            <img src="{{ URL('/uploads/'.$card['image']) }}" alt="" class="w-full h-full object-cover my-auto" alt="card_image">
                                        @else
                                            <img src="{{ URL('/assets/mini-logo.png') }}" alt="" class="w-full h-full object-cover my-auto" alt="card_image">
                                        @endif
                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    {{ $card['code'] }}
                                </td>
                                <td class="px-3 py-2">
                                    @if($card['skill'] === 0)
                                        ทักษะการสอดส่องมองหา
                                    @elseif($card['skill'] === 1)
                                        ทักษะการใส่ใจรับฟัง
                                    @elseif($card['skill'] === 2)
                                        ทักษะการส่งต่อเชื่อมโยง
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    @if($card['color'] === 0)
                                        สีแดง
                                    @elseif($card['color'] === 1)
                                        สีเหลือง
                                    @elseif($card['color'] === 2)
                                        สีเขียว
                                    @elseif($card['color'] === 3)
                                        สีฟ้า
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    {{ $card['name'] }}
                                </td>
                                <td class="px-3 py-2">
                                    @if($card['description'])
                                        {{ $card['description'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-2xl whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-3">
                                        <button class="btn-card-edit hover:text-blue-700 duration-300"
                                        data-card_id="{{ $card['card_id'] }}" data-code="{{ $card['code'] }}" data-skill="{{ $card['skill'] }}" 
                                        data-color="{{ $card['color'] }}" data-name="{{ $card['name'] }}" data-description="{{ $card['description'] }}" 
                                        data-image="{{ isset($card['image']) ? URL('/uploads/' . $card['image']) : '' }}">
                                            <i class='bx bx-edit' ></i>
                                        </button>

                                        <button class="btn-card-delete hover:text-rose-700 duration-300" 
                                        data-route="{{ Route('SubmitCardDelete') }}" data-card_id="{{ $card['card_id'] }}" data-code="{{ $card['code'] }}">
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
            @if(sizeof($cards))
                <div class="hidden max-md:block min-w-[250px] bg-white p-4 rounded-t-2xl overflow-hidden">
                    @foreach($cards as $key => $card)
                        <div class="flex items-center relative">
                            <div class="min-w-[60px] max-w-[80px] pr-2">
                                @if($card['image'])
                                    <img src="{{ URL('/uploads/' . $card['image']) }}" alt="" class="w-full h-auto object-scale-down mx-auto rounded border p-1">
                                @else
                                    <img src="{{ URL('/assets/mini-logo.png') }}" alt="" class="w-full h-auto object-scale-down mx-auto rounded border p-1">
                                @endif
                            </div>
                            <div class="absolute top-0 right-0 bg-gray-200 rounded-full px-2 text-gray-500 text-sm"># {{ $loop->iteration + $cards->firstItem() - 1 }}</div>
                            <div class="flex-col">
                                <p class="text-sm font-medium text-gray-500">รหัส: 
                                    <span class="font-light">
                                        {{ $card['code'] }}
                                    </span>
                                </p>
                                <p class="text-sm font-medium text-gray-500 truncate">ทักษะ: 
                                    <span class="font-light">
                                        @if($card['skill'] === 0)
                                            ทักษะการสอดส่องมองหา
                                        @elseif($card['skill'] === 1)
                                            ทักษะการใส่ใจรับฟัง
                                        @elseif($card['skill'] === 2)
                                            ทักษะการส่งต่อเชื่อมโยง
                                        @endif
                                    </span>
                                </p>
                                <p class="text-sm font-medium text-gray-500">ชื่อการ์ด: 
                                    <span class="font-light">
                                        {{ $card['name'] }}
                                    </span>
                                </p>
                                <p class="text-sm font-medium text-gray-500">รายละเอียด: 
                                    <span class="font-light">
                                        {{ $card['description'] }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-1 mt-2">
                            <button class="btn-card-edit flex items-center justify-center gap-1 bg-blue-500 hover:bg-blue-600 text-white text-sm px-2 py-1 rounded-3xl truncate duration-300" 
                            data-card_id="{{ $card['card_id'] }}" data-type="{{ $card['type'] }}" data-description="{{ $card['description'] }}" data-email="{{ $card['email'] }}" data-image="{{ isset($card['image']) ? URL('/uploads/' . $card['image']) : '' }}">
                            <i class='bx bx-edit' ></i>แก้ไข</button>
    
                            <button class="btn-card-delete flex items-center justify-center gap-1 bg-red-500 hover:bg-red-600 text-white text-sm px-2 py-1 rounded-3xl truncate duration-300" 
                            data-route="{{ Route('SubmitCardDelete') }}" data-card_id="{{ $card['card_id'] }}" data-description="{{ $card['description'] }}">
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
        
        {!! $cards->links('pagination.Pagination') !!}
        @include('pagination.Pagination', ['data_paginate' => $cards])
    </div>
    <!-- END CONTENT -->


    <!-- START MODAL CARD ADD -->
    <div id="modal-card-add" class="modal hidden z-[100] fixed flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content relative bg-white m-auto p-[20px] rounded-md">
            <div class="flex items-center">
                <p class="text-xl font-bold w-full ml-4 text-center">เพิ่มการ์ดทักษะ</p>
                <span id="icon-card-add-close" class="text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
            </div>
            <hr class="mt-4">
            <div class="mt-2">
                <form action="#!" method="post" onsubmit="return false;" class="m-0"
                id="form-card-add" data-route="{{ Route('SubmitCardAdd') }}">
                    <div class="grid gap-6 mb-6 grid-cols-2">
                        <div class="max-sm:col-span-2 grid grid-cols-2 gap-2">
                            <div class="max-sm:col-span-2">
                                <label for="card_code_add" class="block mb-2 text-md font-medium text-gray-700">รหัสการ์ด <span class="text-red-800 text-xl">*</span></label>
                                <input type="text" id="card_code_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกรหัสการ์ด" required>
                            </div>
                            <div class="max-sm:col-span-2">
                                <label for="card_color_add" class="block mb-2 text-md font-medium text-gray-700">ทักษะ <span class="text-red-800 text-xl">*</span></label>
                                <select id="card_color_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                    <option selected value="0" class="font-light">สีแดง</option>
                                    <option value="1" class="font-light">สีเหลือง</option>
                                    <option value="2" class="font-light">สีเขียว</option>
                                    <option value="3" class="font-light">สีฟ้า</option>
                                </select>
                            </div>
                        </div>
                        <div class="max-sm:col-span-2">
                            <label for="card_skill_add" class="block mb-2 text-md font-medium text-gray-700">ทักษะ <span class="text-red-800 text-xl">*</span></label>
                            <select id="card_skill_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option selected value="0" class="font-light">ทักษะการสอดส่องมองหา</option>
                                <option value="1" class="font-light">ทักษะการใส่ใจรับฟัง</option>
                                <option value="2" class="font-light">ทักษะการส่งต่อเชื่อมโยง</option>
                            </select>
                        </div>
                        <div class="max-sm:col-span-2">
                            <label for="card_name_add" class="block mb-2 text-md font-medium text-gray-700">ชื่อการ์ด <span class="text-red-800 text-xl">*</span></label>
                            <input type="text" id="card_name_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกชื่อการ์ด" required>
                        </div>
                        <div class="max-sm:col-span-2">
                            <label for="card_description_add" class="block mb-2 text-md font-medium text-gray-700">รายละเอียด</label>
                            <input type="text" id="card_description_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกรายละเอียด">
                        </div>
                        <div class="max-md:col-span-2">
                            <p class="mb-2 text-md font-medium text-gray-700">รูปภาพ <span class="text-red-800 text-xl">*</span></p>
                            <div class="flex items-center space-x-2 bg-gray-200 rounded-lg w-full">
                                <div class="shrink-0 ml-1 mt-1 mb-1 bg-white rounded-full">
                                    <img id='image_add' class="h-11 w-11 object-cover rounded-full" src="{{ URL('/assets/mini-logo.png') }}" alt="Current profile photo" />
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
                    <button type="submit" onClick={SubmitCardAdd()} class="w-full text-md font-medium text-white text-center bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL CARD ADD -->
    
    <!-- START MODAL CARD EDIT -->
    <div id="modal-card-edit" class="modal hidden z-[100] fixed flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content relative bg-white m-auto p-[20px] rounded-md">
            <div class="flex items-center">
                <p class="text-xl font-bold w-full ml-4 text-center">แก้ไขการ์ดทักษะ</p>
                <span id="icon-card-edit-close" class="text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
            </div>
            <hr class="mt-4">
            <div class="mt-2">
                <form action="#!" method="post" onsubmit="return false;" class="m-0"
                id="form-card-edit" data-route="{{ Route('SubmitCardEdit') }}">
                    <input id="card_id_edit" type="hidden">
                    <div class="grid gap-6 mb-6 grid-cols-2">
                        <div class="max-sm:col-span-2 grid grid-cols-2 gap-2">
                            <div class="max-sm:col-span-2">
                                <label for="card_code_edit" class="block mb-2 text-md font-medium text-gray-700">รหัสการ์ด <span class="text-red-800 text-xl">*</span></label>
                                <input type="text" id="card_code_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกรหัสการ์ด" required>
                            </div>
                            <div class="max-sm:col-span-2">
                                <label for="card_color_edit" class="block mb-2 text-md font-medium text-gray-700">ทักษะ <span class="text-red-800 text-xl">*</span></label>
                                <select id="card_color_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                    <option selected value="0" class="font-light">สีแดง</option>
                                    <option value="1" class="font-light">สีเหลือง</option>
                                    <option value="2" class="font-light">สีเขียว</option>
                                    <option value="3" class="font-light">สีฟ้า</option>
                                </select>
                            </div>
                        </div>
                        <div class="max-sm:col-span-2">
                            <label for="card_skill_edit" class="block mb-2 text-md font-medium text-gray-700">ทักษะ <span class="text-red-800 text-xl">*</span></label>
                            <select id="card_skill_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option selected value="0" class="font-light">ทักษะการสอดส่องมองหา</option>
                                <option value="1" class="font-light">ทักษะการใส่ใจรับฟัง</option>
                                <option value="2" class="font-light">ทักษะการส่งต่อเชื่อมโยง</option>
                            </select>
                        </div>
                        <div class="max-sm:col-span-2">
                            <label for="card_name_edit" class="block mb-2 text-md font-medium text-gray-700">ชื่อการ์ด <span class="text-red-800 text-xl">*</span></label>
                            <input type="text" id="card_name_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกชื่อการ์ด" required>
                        </div>
                        <div class="max-sm:col-span-2">
                            <label for="card_description_edit" class="block mb-2 text-md font-medium text-gray-700">รายละเอียด</label>
                            <input type="text" id="card_description_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกรายละเอียด">
                        </div>
                        <div class="max-md:col-span-2">
                            <p class="mb-2 text-md font-medium text-gray-700">รูปภาพ <span class="text-red-800 text-xl">*</span></p>
                            <div class="flex items-center space-x-2 bg-gray-200 rounded-lg w-full">
                                <div class="shrink-0 ml-1 mt-1 mb-1 bg-white rounded-full">
                                    <img id='image_edit' class="h-11 w-11 object-cover rounded-full" src="{{ URL('/assets/mini-logo.png') }}" alt="Current profile photo" />
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
                    <button type="submit" onClick={SubmitCardEdit()} class="w-full text-md font-medium text-white text-center bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL CARD EDIT -->

@endsection

@push('script')
    <script src="{{ secure_asset('js/admin/Cards.js') }}" defer></script>
@endpush