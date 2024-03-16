<!-- START BACKGROUND -->
<div class="absolute top-0 left-0 h-full w-full">
    <img src="{{ URL('/assets/'.'bg.png') }}" alt="" class="w-full h-full object-cover my-auto" alt="bg">
</div>
<!-- END BACKGROUND -->

<!-- START HEADER -->
<div class="z-[100] top-0 left-0 flex w-full pt-[1em] px-[5em]">
    <!-- START IMAGES -->
    <div class="z-[100] flex items-center w-fit max-lg:mx-auto">
        <div class="w-[125px] max-md:w-[125px] overflow-hidden">
            <img src="{{ URL('assets/mini-logo.png') }}" alt="" class="w-full h-full my-auto" alt="logo">
        </div>
    </div>
    <!-- END IMAGES -->

    <!-- START LIST MENU -->
    <ul class="z-[100] max-md:hidden ml-auto flex w-fit gap-4 text-xl text-white font-medium whitespace-nowrap">
        <li class="flex items-center justify-center text-[16px]">
            <a href="{{ Route('HomePage') }}" class="group hover:text-sky-300 transition duration-300">
                หน้าหลัก
                <span class="block max-w-0 group-hover:max-w-full transition-all duration-500 h-0.5 bg-sky-300"></span>
            </a>
        </li>
        <li class="flex items-center justify-center text-[16px]">
            <a href="{{ Route('RulePage') }}" class="group hover:text-sky-300 transition duration-300">
                กฎการเล่น
                <span class="block max-w-0 group-hover:max-w-full transition-all duration-500 h-0.5 bg-sky-300"></span>
            </a>
        </li>
        <li class="flex items-center justify-center text-[16px]">
            <a href="{{ Route('AboutPage') }}" class="group hover:text-sky-300 transition duration-300">
                การปฐมพยาบาลทางใจ
                <span class="block max-w-0 group-hover:max-w-full transition-all duration-500 h-0.5 bg-sky-300"></span>
            </a>
        </li>
        <li class="flex items-center justify-center text-[16px]">
            <a href="" class="group hover:text-sky-300 transition duration-300">
                กระทู้
                <span class="block max-w-0 group-hover:max-w-full transition-all duration-500 h-0.5 bg-sky-300"></span>
            </a>
        </li>
        <li class="flex items-center justify-center text-[16px]">
            <a href="" class="group hover:text-sky-300 transition duration-300">
                คำถามทั่วไป
                <span class="block max-w-0 group-hover:max-w-full transition-all duration-500 h-0.5 bg-sky-300"></span>
            </a>
        </li>
    </ul>
    <li class="ml-8 relative flex items-center justify-center max-md:absolute max-md:top-3 max-md:right-3">
        @if(!Session::get('username'))
            <button id="btn-login" class="bg-[#EE609A] hover:bg-[#d62c65] rounded-full text-white px-2 py-1 border border-white duration-300 whitespace-nowrap">เข้าสู่ระบบ</button>
        @else
            <div id="btn-logged-in" class="flex items-center gap-1 cursor-pointer">
                <div class="relative flex items-center w-full text-gray-700 gap-2 px-2 py-1.5">
                    <div class="z-10 w-full h-full absolute top-0 left-0 bg-indigo-200 opacity-50 rounded-full"></div>
                    <div class="z-20 relative bg-white w-9 h-9 rounded-full p-1 overflow-hidden border">
                        @if(Session::get('image'))
                            <img src="{{ URL('/uploads/' . Session::get('image')) }}" alt="" class="w-full h-full object-cover my-auto scale-125" alt="logo">
                        @else
                            <img src="{{ URL('/assets/'.'member.png') }}" alt="" class="w-full h-full object-cover my-auto scale-125" alt="logo">
                        @endif
                    </div>
                    <div id="span-firstname" class="z-20 inline-flex flex items-center text-white hover:text-indigo-700">
                        <span class="text-lg overflow-x-hidden duration-300">{{ Session::get('username') }}</span>
                        <i id="icon-logged-sort" class='bx bx-chevron-up mt-[-3px] text-2xl duration-300' ></i>
                    </div>
                </div>
            </div>
            <div id="popup-logged-in" class="hidden z-50 absolute mt-[125px] right-0 z-10 w-40 origin-top-right rounded-md bg-white drop-shadow overflow-hidden ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="">
                    <button id="btn-account-edit" class="flex items-center gap-1 w-full px-4 py-2 text-sm text-gray-500 hover:bg-blue-100 hover:text-blue-700 duration-300"
                    onClick="FetchAccountData(this)" data-route="{{ Route('FetchAccountData') }}" data-username="{{ Session::get('username') }}">
                        <i class="fi fi-rr-portrait text-lg"></i>บัญชีของฉัน
                    </button>
                    <button id="btn-logout" class="flex items-center gap-1 w-full px-4 py-2 text-sm text-gray-500 hover:bg-rose-100 hover:text-rose-700 duration-300">
                        <i class="fi fi-rr-sign-out-alt text-lg ml-1"></i>ออกจากระบบ
                    </button>
                </div>
            </div>
        @endif
    </li>
    <!-- END LIST MENU -->
</div>
<!-- END HEADER -->

@include('admin/components/ModalProfile')

<!-- START MODAL REGISTER -->
<div id="modal-register" class="modal hidden fixed z-[100] flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
    <!-- START MODAL CONTENT -->
    <div class="modal-content bg-white m-auto rounded-2xl drop-shadow-xl w-fit max-md:max-w-[400px] max-sm:w-full">
        <span id="icon-register-close" class="z-50 text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
        <div class="grid grid-cols-2 px-3 py-5 max-md:grid-cols-1 max-md:py-3">
            <!-- START IMAGE -->
            <div class="flex items-center justify-center pr-3 mb-3 border-r border-gray-300 max-md:border-none max-md:pr-0 max-md:mb-0">
                <div class="relative w-[250px] max-md:w-[200px] overflow-hidden">
                    <img src="{{ URL('/assets/web_based_board_game/element-16.png') }}" class="w-full h-full my-auto object-cover" alt="logo">
                </div>
            </div>
            <!-- END IMAGE -->

            <!-- START FORM -->
            <form action="#!" method="post" onsubmit="return false;" class="m-0">
                <div class="relative w-full m-auto">
                    <div class="m-auto mx-3">
                        <h1 class="text-[#382F79] text-2xl flex items-center justify-center font-bold uppercase">สมัครสมาชิก</h1>
                        <div class="grid grid-cols-2 gap-3 mb-4 w-[300px] max-md:w-full">
                            <div class="relative mt-2 max-md:mt-0">
                                <label for="username_register" class="block text-sm font-medium leading-6 text-[#382F79]">ชื่อผู้ใช้ <span class="text-red-800 text-xl">*</span></label>
                                <input type="text" id="username_register" placeholder="กรุณากรอกชื่อผู้ใช้" class="block w-full rounded-full border-0 bg-indigo-50 px-2 py-1.5 font-light text-[14px] text-gray-900 shadow-sm ring-1 ring-inset ring-violet-300" autocomplete="on">
                            </div>
                            <div class="relative mt-2 max-md:mt-0">
                                <label for="password" class="block text-sm font-medium leading-6 text-[#382F79]">รหัสผ่าน <span class="text-red-800 text-xl">*</span></label>
                                <input type="password" id="password_register" placeholder="กรุณากรอกรหัสผ่าน" class="block w-full rounded-full border-0 bg-indigo-50 px-2 py-1.5 font-light text-[14px] text-gray-900 shadow-sm ring-1 ring-inset ring-violet-300" autocomplete="on">
                            </div>
                            <div class="relative mt-2 max-md:mt-0">
                                <label for="email_register" class="block text-sm font-medium leading-6 text-[#382F79]">อีเมล</label>
                                <input type="text" id="email_register" placeholder="กรุณากรอกอีเมล" class="block w-full rounded-full border-0 bg-indigo-50 px-2 py-1.5 font-light text-[14px] text-gray-900 shadow-sm ring-1 ring-inset ring-violet-300" autocomplete="on">
                            </div>
                            <div class="relative mt-2 max-md:mt-0">
                                <div class="inline-flex flex items-center gap-2">
                                    <label for="phone_register" class="block text-sm font-medium leading-6 text-[#382F79]">โทรศัพท์</label>
                                </div>
                                <input type="text" id="phone_register" placeholder="กรุณากรอกเบอร์โทรศัพท์" class="block w-full rounded-full border-0 bg-indigo-50 px-2 py-1.5 font-light text-[14px] text-gray-900 shadow-sm ring-1 ring-inset ring-violet-300" autocomplete="on">
                            </div>
                        </div>
                        <hr class="mt-4 mb-2">
                        <button onClick="RegisterProcess()" type="submit" class="flex w-full justify-center rounded-full bg-[#EE609A] hover:bg-[#d62c65] px-3 py-1.5 leading-6 text-white shadow-sm duration-300">สมัครสมาชิก</button>
                    </div>
                    <div class="text-sm text-center mt-2">
                        <p class="text-gray-500 font-light">มีบัญชีผู้ใช้แล้ว?
                            <span id="modal-register-to-login" class="text-[#EE609A] font-medium hover:underline duration-300 cursor-pointer">เข้าสู่ระบบ</span>
                        </p>
                    </div>
                </div>
            </form>
            <!-- END FORM -->
        </div>
    </div>
    <!-- END MODAL CONTENT -->
</div>
<!-- END MODAL REGISTER -->

<!-- START MODAL LOGIN -->
<div id="modal-login" class="modal hidden fixed z-[100] flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
    <!-- START MODAL CONTENT -->
    <div class="modal-content bg-white m-auto rounded-2xl drop-shadow-xl w-fit max-md:max-w-[400px] max-sm:w-full">
        <span id="icon-login-close" class="z-50 text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
        <div class="grid grid-cols-2 px-3 py-5 max-md:grid-cols-1 max-md:py-3">
            <!-- START IMAGE -->
            <div class="flex items-center justify-center pr-3 mb-3 border-r border-gray-300 max-md:border-none max-md:pr-0 max-md:mb-0">
                <div class="relative w-[250px] max-md:w-[200px] overflow-hidden">
                    <img src="{{ URL('/assets/web_based_board_game/element-16.png') }}" class="w-full h-full my-auto object-cover" alt="logo">
                </div>
            </div>
            <!-- END IMAGE -->

            <!-- START FORM -->
            <form action="#!" method="post" onsubmit="return false;" class="m-0">
                <div class="relative w-full m-auto">
                    <div class="m-auto mx-3">
                        <h1 class="text-[#382F79] text-2xl flex items-center justify-center font-bold uppercase">เข้าสู่ระบบ</h1>
                        <div class="mb-4">
                            <div class="relative mt-2 max-md:mt-0">
                                <label for="username_login" class="block text-sm font-medium leading-6 text-[#382F79]">ชื่อผู้ใช้</label>
                                <input type="text" id="username_login" placeholder="กรุณากรอกชื่อผู้ใช้" class="block w-full rounded-full border-0 bg-indigo-50 px-2 py-1.5 font-light text-[14px] text-gray-900 shadow-sm ring-1 ring-inset ring-violet-300" autocomplete="on">
                            </div>
                            <div class="relative mt-2 max-md:mt-0">
                                <label for="password_login" class="block text-sm font-medium leading-6 text-[#382F79]">รหัสผ่าน</label>
                                <input type="password" id="password_login" placeholder="กรุณากรอกรหัสผ่าน" class="block w-full rounded-full border-0 bg-indigo-50 px-2 py-1.5 font-light text-[14px] text-gray-900 shadow-sm ring-1 ring-inset ring-violet-300" autocomplete="on">
                            </div>
                        </div>
                        <hr class="mt-4 mb-2">
                        <button onClick="LoginProcess()" type="submit" class="flex w-full justify-center rounded-full bg-[#EE609A] hover:bg-[#d62c65] px-3 py-1.5 leading-6 text-white shadow-sm duration-300">เข้าสู่ระบบ</button>
                    </div>
                    <div class="text-sm text-center mt-2">
                        <p class="text-gray-500 font-light">ยังไม่มีบัญชีผู้ใช้?
                            <span id="modal-login-to-register" class="text-[#EE609A] font-medium hover:underline duration-300 cursor-pointer">สมัครสมาชิก</span>
                        </p>
                    </div>
                </div>
            </form>
            <!-- END FORM -->
        </div>
    </div>
    <!-- END MODAL CONTENT -->
</div>
<!-- END MODAL LOGIN -->


<script>
    $(document).ready(function() {
        $('#phone_register').on('input', phoneLengthWarning);

        // MODAL LOGIN
        $('#btn-login').on('click', function () {
            $("#modal-login").removeClass('hidden');
        });
        $('#icon-login-close').on('click', function () {
            var modal = $('#modal-login');
            modal.addClass("fade-out-modal");

            setTimeout(function() {
                modal.addClass('hidden');
                modal.removeClass("fade-out-modal");
            }, 500);
        });

        // MODAL REGISTER
        $('#btn-register').on('click', function () {
            $("#modalRegister").removeClass('hidden');
        });
        $('#icon-register-close').on('click', function () {
            var modal = $('#modal-register');
            modal.addClass("fade-out-modal");

            setTimeout(function() {
                modal.addClass('hidden');
                modal.removeClass("fade-out-modal");
            }, 500);
        });

        // BUTTON LOGGED SORT
        $('#btn-logged-in').on('click', function() {
            var span_fistname = $('#span-firstname');
            var popup = $('#popup-logged-in');
            var icon = $('#icon-logged-sort');
        
            if (span_fistname.hasClass('text-white')) {
                span_fistname.removeClass('text-white').addClass('text-gray-700');
                popup.removeClass('hidden');
                icon.addClass('rotate-180');
            } else {
                span_fistname.removeClass('text-gray-700').addClass('text-white');
                popup.addClass('hidden');
                icon.removeClass('rotate-180');
            }
        });
        $(document).mouseup(function(e) {
            var span_fistname = $('#span-firstname');
            var popup = $('#popup-logged-in');

            if (!span_fistname.is(e.target) && span_fistname.has(e.target).length === 0 &&
                !popup.is(e.target) && popup.has(e.target).length === 0) {
                span_fistname.removeClass('text-gray-700').addClass('text-white');
                popup.addClass('hidden');
                $('#icon-logged-sort').removeClass('rotate-180');
            }
        });

        // SWEETALERT LOGOUT
        $('#btn-logout').on('click', function () {
            Swal.fire({
                title: `คุณต้องการออกจากระบบใช่หรือไม่`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ตกลง',
                cancelButtonText: 'ยกเลิก',
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ Route('Logout') }}";
                }
            })
        });

        // SWAP MODAL LOGIN TO REGISTER
        $('#modal-login-to-register').on('click', function () {
            $("#modal-login").addClass('hidden');
            $("#modal-register").removeClass('hidden');
        });
        // SWAP MODAL REGISTER TO LOGIN
        $('#modal-register-to-login').on('click', function () {
            $("#modal-register").addClass('hidden');
            $("#modal-login").removeClass('hidden');
        });
    });

    function phoneLengthWarning() {
        var phoneInput = $(this).val();
        var phoneLengthWarning = $('.phoneLengthWarning');

        if (phoneInput.length > 10) {
            phoneLengthWarning.text('*Invalid format');
            phoneLengthWarning.removeClass('hidden');
        } else {
            phoneLengthWarning.addClass('hidden');
        }
    }

    var isLoading = false;

    function RegisterProcess(){
        if(!isLoading) {
            isLoading = true;
            fetch("{{ Route('RegisterProcess') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-Token": '{{ csrf_token() }}'
                },
                body:JSON.stringify(
                    {
                        username: document.getElementById("username_register").value,
                        password: document.getElementById("password_register").value,
                        email: document.getElementById("email_register").value,
                        phone: document.getElementById("phone_register").value,
                    }
                )
            })
            .then(async response => {
                const isJson = response.headers.get('content-type')?.includes('application/json');
                const data = isJson ? await response.json() : null; 
        
                if(!response.ok){
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        html: `${data.status}`,
                    });
        
                    const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                    return Promise.reject(error);
                }

                Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'สมัครสมาชิกสำเร็จ',
                        timer: 1000,
                        timerProgressBar: true
                }).then((result) => {
                    $("#modal-register").addClass('hidden');
                    $("#modal-login").removeClass('hidden');
                })

            }).catch((er) => {
                console.log('Error: ' + er);
            })
            .finally(() => {
                isLoading = false;
            });
        }
    }

    function LoginProcess(){
        if(!isLoading) {
            isLoading = true;
            fetch("{{ Route('LoginProcess') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-Token": "{{ csrf_token() }}"
                },
                body:JSON.stringify(
                    {
                        username: document.getElementById("username_login").value,
                        password: document.getElementById("password_login").value
                    }
                )
            })
            .then(async response => {
                const isJson = response.headers.get('content-type')?.includes('application/json');
                const data = isJson ? await response.json() : null; 
        
                if(!response.ok){
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด!',
                        html: `${data.status}`,
                    });
        
                    const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                    return Promise.reject(error);
                }
        
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เข้าสู่ระบบสำเร็จ',
                    timer: 1500,
                    timerProgressBar: true
                }).then((result) => {
                    window.location.reload();
                })
            }).catch((er) => {
                console.log('Error: ' + er);
            })
            .finally(() => {
                isLoading = false;
            });
        }
    }
</script>