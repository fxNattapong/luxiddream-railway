<!-- START SIDEBAR -->
<nav id="sidebar" class="z-[100] relative sticky fixed top-0 left-0 min-w-[250px] max-w-[250px] max-md:min-w-0 max-md:max-w-[60px] bg-white min-h-[100vh] drop-shadow duration-300">
    <!-- START SWITCH -->
    <div id="btn-menu-switch" class="z-[100] hidden max-md:block absolute right-0 mr-[-9px] mt-[25px] flex items-center bg-[#8388d1] rounded-full duration-300">
        <i class='bx bx-chevron-right text-xl text-white'></i>
    </div>
    <!-- END SWITCH -->

    <div class="flex flex-col h-[100vh] px-6 max-md:px-[10px]">
        <div class="z-1 absolute top-0 left-0 w-full h-full">
            <img src="{{ URL('/assets/bg.png') }}" alt="bg" class="w-full h-full object-cover">
        </div>

        <!-- START HEADER -->
        <div class="flex items-center justify-center gap-2 mt-5">
            <div id="img-logo" class="z-50 relative bg-white rounded-full w-auto max-md:min-w-[45px] h-[80px] max-md:h-full p-1 overflow-hidden">
                <img src="{{ URL('/assets/mini-logo.png') }}" alt="logo" class="w-full h-full object-cover my-auto">
            </div>
            <div id="text-logo" class="z-50 relative w-auto w-[100px] h-[80px] p-1 overflow-hidden max-md:hidden">
                <img src="{{ URL('/assets/logo.png') }}" alt="logo" class="w-full h-full object-cover my-auto">
            </div>
        </div>
        <!-- END HEADER -->
        <hr>

        <!-- START CONTENT -->
        <nav class="z-50 flex-1 grow mt-4">
            <ul class="flex-col flex justify-between h-full ">
                <!-- START MENU -->
                <li class="grow overflow-hidden">
                    <ul class="text-gray-200 space-y-2 whitespace-nowrap">
                        <li>
                            <a href="{{ Route('Players') }}" id="Players" class="flex items-center font-medium gap-2 w-full p-2 hover:text-indigo-600 hover:bg-[#E4E9F7] duration-300 rounded">
                                <i class='bx bxs-user-rectangle text-2xl'></i>
                                <span>ผู้เล่น</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('PlayersRule') }}" id="PlayersRule" class="flex items-center font-medium gap-2 w-full p-2 hover:text-indigo-600 hover:bg-[#E4E9F7] duration-300 rounded">
                                <i class='bx bxs-user-account text-2xl'></i>
                                <span>กฎผู้เล่น</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('Levels') }}" id="Levels" class="flex items-center font-medium gap-2 w-full p-2 hover:text-indigo-600 hover:bg-[#E4E9F7] duration-300 rounded">
                                <i class='bx bx-expand-horizontal text-2xl'></i>
                                <span>ระดับความยาก</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('Nightmares') }}" id="Nightmares" class="flex items-center font-medium gap-2 w-full p-2 hover:text-indigo-600 hover:bg-[#E4E9F7] duration-300 rounded">
                                <i class='bx bx-ghost text-2xl' ></i>
                                <span>ฝันร้าย</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('Links') }}" id="Links" class="flex items-center font-medium gap-2 w-full p-2 hover:text-indigo-600 hover:bg-[#E4E9F7] duration-300 rounded">
                                <i class='bx bx-link-alt text-2xl'></i>
                                <span>แผ่น</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('Cards') }}" id="Cards" class="flex items-center font-medium gap-2 w-full p-2 hover:text-indigo-600 hover:bg-[#E4E9F7] duration-300 rounded">
                                <i class='bx bx-credit-card-front text-2xl'></i>
                                <span>การ์ดทักษะ</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- END MENU -->

                <!-- START SETTINGS -->
                <li class="relative flex-col flex w-auto mt-auto mb-3 bottom-0">
                    <a onClick="openMenuLogged()" id="btnLoggedMenu" class="relative flex w-[100%] px-2 hover:bg-[#E4E9F7] rounded duration-300 cursor-pointer overflow-hidden">
                        <div class="z-20 flex items-center w-full text-gray-700 gap-2 py-1">
                            <div class="relative bg-white w-[40px] max-md:min-w-[30px] h-[40px] max-md:h-[30px] max-md:ml-[-3px] rounded-full p-1 overflow-hidden border">
                                @if(Session::get('image'))
                                    <img src="{{ URL('/uploads/'.Session::get('image')) }}" alt="" class="w-full h-full object-cover my-auto scale-125" alt="logo">
                                @else
                                    <img src="{{ URL('/assets/member.png') }}" alt="" class="w-full h-full object-cover my-auto scale-125" alt="logo">
                                @endif
                            </div>
                            <span id="btn-logged" class="text-lg overflow-x-hidden">{{ Session::get('username') }}</span>
                            <i id="icon-settings" class='bx bx-chevron-down text-2xl ml-auto mr-0 duration-300'></i>
                        </div>
                        <div class="z-10 w-full h-full absolute top-0 left-0 bg-indigo-200 opacity-50 rounded"></div>
                    </a>

                </li>

                <li class="-mt-2 mb-3 ml-[20px] max-md:ml-0">
                    <div id="menu-logged" class="z-[100] hidden space-y-1 text-white rounded-md duration-800 h-0 duration-300 overflow-hidden">
                        <button id="btn-account-edit" class="relative w-full"
                        onClick="FetchAccountData(this)" data-route="{{ Route('FetchAccountData') }}" data-username="{{ Session::get('username') }}">
                            <div class="flex items-center font-medium gap-2 w-full p-2 hover:text-indigo-600 hover:bg-indigo-100 duration-300 rounded">
                                <i class='z-20 bx bxs-edit text-2xl' ></i>
                                <span class="z-20 whitespace-nowrap">ข้อมูลของฉัน</span>
                            </div>
                            <div class="z-10 w-full h-full absolute top-0 left-0 bg-indigo-300 opacity-50 rounded"></div>
                        </button>
                        <button id="btn-logout" class="relative w-full"
                        data-route="{{ Route('Logout') }}">
                            <div class="flex items-center font-medium gap-2 w-full p-2 hover:text-indigo-600 hover:bg-red-100 duration-300 rounded">
                                <i class='z-20 bx bx-log-out text-2xl' ></i>
                                <span class="z-20 whitespace-nowrap">ออกจากระบบ</span>
                            </div>
                            <div class="z-10 w-full h-full absolute top-0 left-0 bg-red-300 opacity-50 rounded"></div>
                        </button>
                    </div>
                </li>
                <!-- END SETTINGS -->
            </ul>
        </nav>
        <!-- END CONTENT -->
    </div>
</nav>
<!-- END SIDEBAR -->

@include('admin/components/ModalProfile')