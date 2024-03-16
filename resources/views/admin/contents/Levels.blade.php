<title>Levels | LuxidDream</title>

@extends('admin/layouts/Layout')

@section('Content')

    <!-- START HEADER -->
    <div class="relative w-[100%] bg-[#dbcae8] p-6 max-md:px-3 mb-6 shadow-md">
        <div class="flex relative">
            <div class="flex items-center whitespace-nowrap text-2xl text-gray-700 font-medium gap-2 overflow-hidden">
                <i class='bx bx-expand-horizontal text-3xl'></i>
                <span class="">จัดการระดับความยาก</span>
            </div>

            <button id="btn-level-add" class="flex items-center ml-auto mr-0 whitespace-nowrap h-full bg-[#8388d1] hover:bg-[#6c6ac1] rounded px-2 py-1.5 text-white font-medium duration-300">
                <i class='bx bx-plus text-2xl'></i>
                <span>เพิ่มระดับ</span>
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
                            ระดับ
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            จำนวนรอบ
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            เวลา <span class="font-light">(นาที)</span>
                        </th>
                        <th scope="col" class="px-3 py-2 font-medium text-center">
                            การกระทำ
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-500">
                    @if(sizeof($levels))
                        @foreach($levels as $key => $level)
                            <tr class="bg-white border-b font-light whitespace-nowrap text-center">
                                <td scope="row" class="px-2 py-2">
                                    {{ $key + 1 }}
                                </td>
                                <td scope="row" class="px-2 py-2">
                                    @if($level['level'] === 0)
                                        ง่าย
                                    @elseif($level['level'] === 1)
                                        ปานกลาง
                                    @else
                                        ยาก
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    {{ $level['round'] }}
                                </td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center justify-center">
                                        {{ $level['time_1'] }} <i class='bx bx-right-arrow-alt'></i> 
                                        {{ $level['time_2'] }} <i class='bx bx-right-arrow-alt'></i> 
                                        {{ $level['time_3'] }} <i class='bx bx-right-arrow-alt'></i> 
                                        {{ $level['time_4'] }}

                                        @if($level['time_5'])
                                            <i class='bx bx-right-arrow-alt'></i> {{ $level['time_5'] }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-3 py-2 text-2xl whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-3">
                                        <button class="btn-level-edit hover:text-blue-700 duration-300"
                                        data-level_id="{{ $level['level_id'] }}" data-level="{{ $level['level'] }}" data-round="{{ $level['round'] }}"
                                        data-time_1="{{ $level['time_1'] }}" data-time_2="{{ $level['time_2'] }}" data-time_3="{{ $level['time_3'] }}"
                                        data-time_4="{{ $level['time_4'] }}" data-time_5="{{ $level['time_5'] }}">
                                            <i class='bx bx-edit' ></i>
                                        </button>

                                        <button class="btn-level-delete hover:text-rose-700 duration-300" 
                                        data-route="{{ Route('SubmitLevelDelete') }}" data-level_id="{{ $level['level_id'] }}" data-level="{{ $level['level'] }}">
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
            @if(sizeof($levels))
                <div class="hidden max-md:block min-w-[250px] bg-white p-4 rounded-t-2xl overflow-hidden">
                    @foreach($levels as $key => $level)
                        <div class="flex items-center relative">
                            <div class="absolute top-0 right-0 bg-gray-200 rounded-full px-2 text-gray-500 text-sm"># {{ $key + 1 }}</div>
                            <div class="flex-col">
                                <p class="text-sm font-medium text-gray-500 truncate">
                                    ระดับความยาก: <span class="font-light">
                                        @if($level['level'] === 0)
                                            ง่าย
                                        @elseif($level['level'] === 1)
                                            ปานกลาง
                                        @else
                                            ยาก
                                        @endif
                                    </span>
                                </p>
                                <p class="text-sm font-medium text-gray-500 truncate">
                                    จำนวนรอบ: <span class="font-light">{{ $level['round'] }}</span>
                                </p>
                                <p class="text-sm font-medium text-gray-500 inline-flex">
                                    เวลา:&nbsp;<span class="font-light flex items-center">
                                        {{ $level['time_1'] }}<i class='bx bx-right-arrow-alt'></i>
                                        {{ $level['time_2'] }}<i class='bx bx-right-arrow-alt'></i>
                                        {{ $level['time_3'] }}<i class='bx bx-right-arrow-alt'></i>
                                        {{ $level['time_4'] }}

                                        @if($level['time_5'])
                                            <i class='bx bx-right-arrow-alt'></i>{{ $level['time_5'] }}
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-1 mt-2">
                            <button class="btn-level-edit flex items-center justify-center gap-1 bg-blue-500 hover:bg-blue-600 text-white text-sm px-2 py-1 rounded-3xl truncate duration-300" 
                            data-level_id="{{ $level['level_id'] }}" data-level="{{ $level['level'] }}" data-round="{{ $level['round'] }}"
                            data-time_1="{{ $level['time_1'] }}" data-time_2="{{ $level['time_2'] }}" data-time_3="{{ $level['time_3'] }}"
                            data-time_4="{{ $level['time_4'] }}" data-time_5="{{ $level['time_5'] }}">
                            <i class='bx bx-edit' ></i>แก้ไข</button>

                            <button class="btn-level-delete flex items-center justify-center gap-1 bg-red-500 hover:bg-red-600 text-white text-sm px-2 py-1 rounded-3xl truncate duration-300" 
                            data-route="{{ Route('SubmitLevelDelete') }}" data-level_id="{{ $level['level_id'] }}" data-level="{{ $level['level'] }}">
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


    <!-- START MODAL PLAYER ADD -->
    <div id="modal-level-add" class="modal hidden z-[100] fixed flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content relative bg-white m-auto p-[20px] rounded-md max-sm:w-[100%] overflow-hidden">
            <div class="flex items-center">
                <p class="text-xl font-bold w-full ml-4 text-center whitespace-nowrap">เพิ่มระดับความยาก</p>
                <span id="icon-level-add-close" class="text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
            </div>
            <hr class="mt-4">
            <div class="mt-2">
                <form action="#!" method="post" onsubmit="return false;" class="m-0"
                id="form-level-add" data-route="{{ Route('SubmitLevelAdd') }}">
                    <div class="grid gap-6 mb-6 grid-cols-2">
                        <div class="max-sm:col-span-2">
                            <label for="level_add" class="block mb-2 text-md font-medium text-gray-700 whitespace-nowrap">ระดับความยาก</label>
                            <select id="level_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option selected value="0" class="font-light">ง่าย</option>
                                <option value="1" class="font-light">ปานกลาง</option>
                                <option value="2" class="font-light">ยาก</option>
                            </select>
                        </div>

                        <div class="max-sm:col-span-2">
                            <label for="level_round_add" class="block mb-2 text-md font-medium text-gray-700">จำนวนรอบ</label>
                            <input type="text" id="level_round_add" class="bg-gray-200 border border-gray-300 text-gray-700 text-md font-light rounded-lg block w-full p-2 outline-none" value="5" readonly>
                        </div>

                        <div class="col-span-2">
                            <label for="time" class="block mb-2 text-md font-medium text-gray-700">เวลา (นาที)</label>
                            <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                                <div class="relative">
                                    <label for="time_1_add" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 1</label>
                                    <select id="time_1_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option value="3.30" class="font-light">3.30</option>
                                        <option value="4.00" class="font-light">4.00</option>
                                        <option value="5.00" class="font-light">5.00</option>
                                        <option value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option selected value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="time_2_add" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 2</label>
                                    <select id="time_2_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option value="3.30" class="font-light">3.30</option>
                                        <option value="4.00" class="font-light">4.00</option>
                                        <option value="5.00" class="font-light">5.00</option>
                                        <option selected value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="time_3_add" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 3</label>
                                    <select id="time_3_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option value="3.30" class="font-light">3.30</option>
                                        <option value="4.00" class="font-light">4.00</option>
                                        <option selected value="5.00" class="font-light">5.00</option>
                                        <option value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="time_4_add" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 4</label>
                                    <select id="time_4_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option value="3.30" class="font-light">3.30</option>
                                        <option selected value="4.00" class="font-light">4.00</option>
                                        <option value="5.00" class="font-light">5.00</option>
                                        <option value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="time_5_add" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 5</label>
                                    <select id="time_5_add" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option selected value="3.30" class="font-light">3.30</option>
                                        <option value="4.00" class="font-light">4.00</option>
                                        <option value="5.00" class="font-light">5.00</option>
                                        <option value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-1 mt-3">
                    <button type="submit" onClick={SubmitLevelAdd()} class="w-full text-md font-medium text-white text-center bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL PLAYER ADD -->
    
    <!-- START MODAL PLAYER EDIT -->
    <div id="modal-level-edit" class="modal hidden z-[100] fixed flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content relative bg-white m-auto p-[20px] rounded-md max-sm:w-[100%] overflow-hidden">
            <div class="flex items-center">
                <p class="text-xl font-bold w-full ml-4 text-center whitespace-nowrap">แก้ไขระดับความยาก</p>
                <span id="icon-level-edit-close" class="text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
            </div>
            <hr class="mt-4">
            <div class="mt-2">
                <form action="#!" method="post" onsubmit="return false;" class="m-0"
                id="form-level-edit" data-route="{{ Route('SubmitLevelEdit') }}">
                    <input id="level_id_edit" type="hidden">
                    <div class="grid gap-6 mb-6 grid-cols-2">
                        <div class="max-sm:col-span-2">
                            <label for="level_edit" class="block mb-2 text-md font-medium text-gray-700 whitespace-nowrap">ระดับความยาก</label>
                            <select id="level_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option selected value="0" class="font-light">ง่าย</option>
                                <option value="1" class="font-light">ปานกลาง</option>
                                <option value="2" class="font-light">ยาก</option>
                            </select>
                        </div>

                        <div class="max-sm:col-span-2">
                            <label for="level_round_edit" class="block mb-2 text-md font-medium text-gray-700">จำนวนรอบ</label>
                            <input type="text" id="level_round_edit" class="bg-gray-200 border border-gray-300 text-gray-700 text-md font-light rounded-lg block w-full p-2 outline-none" value="5" readonly>
                        </div>

                        <div class="col-span-2">
                            <label for="time" class="block mb-2 text-md font-medium text-gray-700">เวลา (นาที)</label>
                            <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                                <div class="relative">
                                    <label for="time_1_edit" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 1</label>
                                    <select id="time_1_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option value="3.30" class="font-light">3.30</option>
                                        <option value="4.00" class="font-light">4.00</option>
                                        <option value="5.00" class="font-light">5.00</option>
                                        <option value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="time_2_edit" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 2</label>
                                    <select id="time_2_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option value="3.30" class="font-light">3.30</option>
                                        <option value="4.00" class="font-light">4.00</option>
                                        <option value="5.00" class="font-light">5.00</option>
                                        <option value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="time_3_edit" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 3</label>
                                    <select id="time_3_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option value="3.30" class="font-light">3.30</option>
                                        <option value="4.00" class="font-light">4.00</option>
                                        <option value="5.00" class="font-light">5.00</option>
                                        <option value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="time_4_edit" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 4</label>
                                    <select id="time_4_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option value="3.30" class="font-light">3.30</option>
                                        <option value="4.00" class="font-light">4.00</option>
                                        <option value="5.00" class="font-light">5.00</option>
                                        <option value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <label for="time_5_edit" class="absolute block -mt-3 text-sm font-light text-gray-700 bg-white px-2 rounded-full">รอบที่ 5</label>
                                    <select id="time_5_edit" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="3.00" class="font-light">3.00</option>
                                        <option value="3.30" class="font-light">3.30</option>
                                        <option value="4.00" class="font-light">4.00</option>
                                        <option value="5.00" class="font-light">5.00</option>
                                        <option value="6.00" class="font-light">6.00</option>
                                        <option value="6.30" class="font-light">6.30</option>
                                        <option value="7.00" class="font-light">7.00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-1 mt-3">
                    <button type="submit" onClick={SubmitLevelEdit()} class="w-full text-md font-medium text-white text-center bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL PLAYER EDIT -->

@endsection

@push('script')
    <script src="{{ secure_asset('js/admin/Levels.js') }}" defer></script>
@endpush