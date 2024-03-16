<!-- START BUTTON MENU -->
<div id="sidebar-mobile" class="z-50 hidden max-md:block w-fit h-fit absolute top-3 left-3 cursor-pointer">
    <i class='bx bx-menu bg-[#EE609A] hover:bg-[#d62c65] rounded-full p-1 text-white text-2xl border border-white duration-300'></i>
</div>
<!-- END BUTTON MENU -->

<!-- START SIDEBAR MOBILE -->
<aside id="modal-sidebar-mobile" class="hidden z-[101] modal fixed w-full h-full top-0 left-0">
    <div class="modal-mobile-left-bar absolute left-0 bg-[#ced1f7] w-[250px] h-full bg-gradient-to-b from-indigo-900 via-[#e5d8fc] to-pink-200">
        <!-- START CART HEADER -->
        <div class="flex items-center px-[15px] py-[20px]">
            <div class="relative inline-flex items-center w-full gap-1">
                <i class='bx bx-menu text-2xl text-white'></i>
                <span class="text-white text-xl font-medium">เมนู</span>
                <span id="icon-sidebar-mobile-close" class="z-20 text-black bg-white rounded-full drop-shadow border text-[24px] font-bold h-fit font-medium absolute top-0 right-0 mr-2 hover:text-indigo-600 hover:bg-indigo-200 duration-300 cursor-pointer"><i class='bx bx-x'></i></span>
            </div>
        </div>
        <hr class="h-px bg-gray-500 border-0 mt-0">
        <!-- END CART HEADER -->

        <!-- START CONTENT -->
        <div class="px-[15px] py-[20px]">
            <ul class="font-light space-y-[0.438em] whitespace-nowrap text-gray-700">
                <li>
                    <a href="{{ Route('HomePage') }}" id="HomePage_Mobile" class="flex items-center font-medium gap-1 w-full hover:text-indigo-700 bg-white rounded-full p-1.5 duration-300">
                        <i class='bx bx-home-alt text-2xl' ></i>
                        <span class="mt-1">หน้าแรก</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('RulePage') }}" id="RulePage_Mobile" class="flex items-center font-medium gap-1 w-full hover:text-indigo-700 bg-white rounded-full p-1.5 duration-300">
                        <i class='bx bx-book-content text-2xl'></i>
                        <span class="mt-1">คู่มือเกม</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('AboutPage') }}" id="AboutPage_Mobile" class="flex items-center font-medium gap-1 w-full hover:text-indigo-700 bg-white rounded-full p-1.5 duration-300">
                        <i class='bx bx-plus-circle text-2xl'></i>
                        <span class="mt-1">การปฐมพยาบาลทางใจ</span>
                    </a>
                </li>
                <li>
                    <a href="" id="_Mobile" class="flex items-center font-medium gap-1 w-full hover:text-indigo-700 bg-white rounded-full p-1.5 duration-300">
                        <i class='bx bx-chat text-2xl'></i>
                        <span class="mt-1">กระทู้</span>
                    </a>
                </li>
                <li>
                    <a href="" id="_Mobile" class="flex items-center font-medium gap-1 w-full hover:text-indigo-700 bg-white rounded-full p-1.5 duration-300">
                        <i class='bx bx-comment-detail text-2xl'></i>
                        <span class="mt-1">คำถามที่มักพบบ่อย</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('HomePage') }}" id="_Mobile" class="flex items-center font-medium gap-1 w-full hover:text-indigo-700 bg-white rounded-full p-1.5 duration-300">
                        <i class='bx bxs-contact text-2xl'></i>
                        <span class="mt-1">ติดต่อเรา</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END CONTENT -->
    </div>
</aside>
<!-- END SIDEBAR MOBILE -->