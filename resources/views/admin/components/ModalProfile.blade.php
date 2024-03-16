<!-- START MODAL ACCOUNT EDIT -->
<div id="modal-account-edit" class="modal hidden z-[101] fixed flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
    <!-- START MODAL CONTENT -->
    <div class="modal-content bg-white m-auto p-[20px] rounded-md drop-shadow-xl xl:w-[40%] lg:w-[60%] md:w-[60%] sm:w-[70%]">
        <div class="flex items-center">
            <p class="text-xl font-bold w-full ml-4 text-center">แก้ไขบัญชีนี้</p>
            <span id="icon-account-edit-close" class="text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-indigo-600 cursor-pointer">&times;</span>
        </div>
        <hr class="mt-4">
        <div class="mt-2">
            <form id="form-account-edit" action="#!" method="post" onsubmit="return false;" class="m-0"
            data-route="{{ Route('SubmitAccountEdit') }}">
                <input type="hidden" id="account_id">
                <div class="grid grid-cols-2 gap-2">
                    <div class="">
                        <label for="account_username" class="block mb-2 text-md font-medium text-gray-700">ชื่อผู้ใช้ <span class="text-white text-xl">*</span></label>
                        <input type="text" id="account_username" class="bg-gray-200 border border-gray-300 text-gray-700 text-md font-light rounded-lg  block w-full p-2 outline-none cursor-not-allowed" readonly>
                    </div>
                    <div class="relative w-full">
                        <label for="account_password" class="block mb-2 text-md font-medium text-gray-700">รหัสผ่าน <span class="text-red-800 text-xl">*</span></label>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 z-10 mt-9">
                            <input class="hidden js-password-toggle" id="toggle" type="checkbox" />
                            <label class="js-password-label bg-gray-300 hover:bg-gray-400 duration-300 rounded px-2 py-1 text-sm text-gray-600 cursor-pointer" for="toggle">แสดง</label>
                        </div>
                        <div class="relative float-label-input">
                            <input type="password" id="account_password" class="js-password bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="รหัสผ่านขั้นต่ำ 4 ตัวอักษร">
                        </div>
                    </div>
                    <div class="">
                        <div class="inline-flex gap-2">
                            <label for="account_phone" class="whitespace-nowrap mb-2 text-md font-medium text-gray-700">หมายเลขโทรศัพท์</label>
                            <span id="phoneLengthWarning" class="hidden text-sm text-rose-700 font-light mt-[2px] max-sm:mt-[3px]"></span>
                        </div>
                        <input type="text" id="account_phone" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกหมายเลขโทรศัพท์">
                    </div>
                    <div class="">
                        <label for="account_email" class="block mb-2 text-md font-medium text-gray-700">อีเมล</label>
                        <input type="text" id="account_email" class="bg-gray-50 border border-gray-300 text-gray-700 text-md font-light rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 outline-none" placeholder="กรุณากรอกอีเมล" required>
                    </div>
                    <div>
                        <label for="account_played_all" class="block mb-2 text-md font-medium text-gray-700">เล่นไปทั้งหมด (ครั้ง)</label>
                        <input type="text" id="account_played_all" class="bg-gray-200 border border-gray-300 text-gray-700 text-md font-light rounded-lg  block w-full p-2 outline-none cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label for="account_played_last" class="block mb-2 text-md font-medium text-gray-700">เล่นล่าสุด</label>
                        <input type="text" id="account_played_last" class="bg-gray-200 border border-gray-300 text-gray-700 text-sm font-light rounded-lg  block w-full px-2 py-2.5 outline-none cursor-not-allowed" readonly>
                    </div>
                    <div class="max-md:col-span-2">
                        <p class="mb-2 text-md font-medium text-gray-700">รูปภาพผู้ใช้</p>
                        <div class="flex items-center space-x-2 bg-gray-200 rounded-lg w-full">
                            <div class="shrink-0 ml-1 mt-1 mb-1 bg-white rounded-full">
                                <img id='account_image' class="h-11 w-11 object-cover rounded-full" src="{{ URL('/assets/'.'admin.png') }}" alt="Current profile photo" />
                            </div>
                            <label class="block w-fit">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" onChange={fileChosen_Single(event)} id="account_image" name="image" accept="image/png, image/jpeg" class="block w-full text-sm text-slate-500
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
                <button type="submit" onClick="SubmitAccountEdit()" class="w-full text-md font-medium text-white text-center bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300">บันทึก</button>
            </form>
        </div>
    </div>
    <!-- END MODAL CONTENT -->
</div>
<!-- END MODAL ACCOUNT EDIT -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // MODAL EDIT
        $('#btn-account-edit').on('click', function() {
            $('#modal-account-edit').removeClass('hidden');
            $('#menu-logged').toggleClass("hidden");
            $('#btnLoggedMenu').toggleClass("bg-[#E4E9F7]");
            $('#btnLoggedMenu .flex').toggleClass("text-gray-700 text-blue-700");
            $('#icon-settings').toggleClass("rotate-180");
        });
        $('#icon-account-edit-close').on('click', function() {
            var modal = $('#modal-account-edit');
            modal.addClass('fade-out-modal');

            setTimeout(function() {
                modal.addClass('hidden');
                modal.removeClass("fade-out-modal");
            }, 500);
        });

        $('#account_phone').on('input', function () {
            var phoneInput = $(this).val();
            var phoneLengthWarning = $('#phoneLengthWarning');
        
            if (phoneInput.length == 10) {
                phoneLengthWarning.addClass('hidden');
            } else if (phoneInput.length > 10) {
                phoneLengthWarning.text('หมายเลขเกิน 10 หลัก');
                phoneLengthWarning.removeClass('hidden');
            } else {
                phoneLengthWarning.text('หมายเลขไม่ถูกต้อง')
                phoneLengthWarning.removeClass('hidden');
            }
        });
    });

    $('.js-password-toggle').on('change', function() {
        const password = $('.js-password'),
            passwordLabel = $('.js-password-label');
        if (password.attr('type') === 'password') {
            password.attr('type', 'text');
            passwordLabel.html('ซ่อน');
        } else {
            password.attr('type', 'password');
            passwordLabel.html('แสดง');
        }
        password.focus();
    });

    // START GET SINGLE IMAGE BASE64
    var _image64_single = '';
    function fileChosen_Single(event) {
        this.fileToDataUrl_Single(event, src => this.fileHanddle_Single(src));
    }
    function fileToDataUrl_Single(event, callback) {
        if (! event.target.files.length){ 
            callback('');
            return
        }

        let file = event.target.files[0],
            reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = function (e) {
            var img = new Image;
            img.src = e.target.result;
            img.onload = function(){
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                var cw = canvas.width;
                var ch = canvas.height;
                var maxW = '1920';
                var maxH = '1080';

                var iw = img.width;
                var ih = img.height;
                if(iw <= maxW || ih <= maxH) {
                    var _avatar_base64 = img.src;
                }else {
                    var scale = Math.min((maxW/iw),(maxH/ih));
                    var iwScaled = iw * scale;
                    var ihScaled = ih * scale;
                    canvas.width = iwScaled;
                    canvas.height = ihScaled;
                    ctx.drawImage(img,0,0,iwScaled,ihScaled);
                    var converted_img = canvas.toDataURL();
                    var _avatar_base64 = converted_img;        
                }                        
                callback(_avatar_base64);                        
            }					
        };
    }
    function fileHanddle_Single(src){
        $("#account_image").attr("src", src);

        $("#image_add").attr("src", src);
        $("#image_edit").attr("src", src);
        
        _image64_single = src;
    }
    // END GET SINGLE IMAGE BASE64

    var isLoading = false;

    function FetchAccountData(element){
        var RouteURL = $("#btn-account-edit").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    username: $(element).data('username')
                }
            )
        })
        .then(async response => {
            const isJson = response.headers.get('content-type')?.includes('application/json');
            const data = isJson ? await response.json() : null; 

            if(!response.ok){
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }

            $('#account_id').val(data.player.player_id);
            $('#account_username').val(data.player.username);
            $('#account_password').val(data.player.password);

            if(data.player.phone) {
                $('#account_phone').val(data.player.phone);
            }
            if(data.player.phone) {
                $('#account_email').val(data.player.email);
            }

            $('#account_played_all').val(data.player.played_all);
            $('#account_played_last').val(data.player.played_last);
            

            if(data.player.image) {
                $('#account_image').attr("src", pathUploads + data.player.image);
            }
            $("#modal-account-edit").removeClass('hidden');
        })
        .catch((er) => {
            console.log('Error' + er);
        })
    }

    function SubmitAccountEdit() {
        if(!isLoading) {
            var RouteURL = $("#form-account-edit").data("route");
            isLoading = true;
            fetch(RouteURL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-Token": csrfToken
                },
                body:JSON.stringify(
                    {
                        player_id: document.getElementById("account_id").value,
                        password: document.getElementById("account_password").value,
                        phone: document.getElementById("account_phone").value,
                        email: document.getElementById("account_email").value,
                        image64: _image64_single
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
                        title: 'แก้ไขบัญชีไม่สำเร็จ!',
                        html: `${data.status}`,
                        confirmButtonText: 'ตกลง',
                    })
        
                    const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                    return Promise.reject(error);
                }
        
                Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'แก้ไขบัญชีสำเร็จ',
                        confirmButtonText: 'ตกลง',
                        timer: 1000,
                        timerProgressBar: true
                }).then((result) => {
                    location.reload();
                })
            })
            .catch((er) => {
                console.log('Error' + er);
            })
            .finally(() => {
                isLoading = false;
            });
        }
    }
</script>