$(document).ready(function() {
    $('#player_phone_add').on('input', phoneLengthWarning);
    $('#player_phone_edit').on('input', phoneLengthWarning);
    
    // MODAL ADD
    $('#btn-player-add').on('click', function() {
        $('#player_image_add').attr('src', pathAssets + 'member.png');
        $('#modal-player-add').removeClass('hidden');
    });
    $('#icon-player-add-close').on('click', function() {
        var modal = $('#modal-player-add');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL EDIT
    $('.btn-player-edit').on('click', function() {
        $('.phoneLengthWarning').addClass('hidden');
        $('#player_id_edit').val($(this).data('id'));
        $('#player_username_edit').val($(this).data('username'));
        $('#player_username_current').val($(this).data('username'));
        $('#player_password_edit').val($(this).data('password'));
        $('#player_phone_edit').val($(this).data('phone'));
        $('#player_email_edit').val($(this).data('email'));
        $('#player_role_edit').val($(this).data('role'));
        if($(this).data('image')) {
            $('#image_edit').attr('src', $(this).data('image'));
        }

        $('#modal-player-edit').removeClass('hidden');

    });
    $('#icon-player-edit-close').on('click', function() {
        var modal = $('#modal-player-edit');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // SWEETALERT DELETE
    $('.btn-player-delete').on('click', function () {
        Swal.fire({
            title: `คุณแน่ใจหรือไม่? <br><b class="text-xl font-medium">(ชื่อผู้ใช้: ${$(this).data('username')})</b>`,
            text: "การดำเนินการนี้ไม่สามารถเรียกคืนได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบ',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                SubmitPlayerDelete($(this).data('player_id'));
            }
        })
    });
});

function phoneLengthWarning() {
    var phoneInput = $(this).val();
    var phoneLengthWarning = $('.phoneLengthWarning');

    if (phoneInput.length == 10) {
        phoneLengthWarning.addClass('hidden');
    } else if (phoneInput.length > 10) {
        phoneLengthWarning.text('หมายเลขเกิน 10 หลัก');
        phoneLengthWarning.removeClass('hidden');
    } else {
        phoneLengthWarning.text('หมายเลขไม่ถูกต้อง')
        phoneLengthWarning.removeClass('hidden');
    }
}

var isLoading = false;

function SubmitPlayerAdd() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-player-add").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    username: document.getElementById("player_username_add").value,
                    password: document.getElementById("player_password_add").value,
                    phone: document.getElementById("player_phone_add").value,
                    email: document.getElementById("player_email_add").value,
                    role: document.getElementById("player_role_add").value,
                    image64: _image64_single,
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
                    title: 'เพิ่มบัญชีไม่สำเร็จ!',
                    html: `${data.status}`,
                    confirmButtonText: 'ตกลง',
                })
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }
    
            Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เพิ่มบัญชีสำเร็จ',
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

function FetchPlayerData(element){
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#btn-player-edit").data("route");
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
    
            $('#player_id').val(data.id_admin);
            $('#player_username').val(data.username);
            $('#player_password').val(data.password);
    
            if(data.phone) {
                $('#player_phone').val(data.phone);
            }
    
            if(data.image) {
                $('#player_image').attr("src", pathUploads + data.image);
            }

            if(data.role === 1) {
                $('#player_role').val('ผู้เล่น');
            } else {
                $('#player_role').val('ผู้ดูแลระบบ');
            }

            $("#modal-player-edit").removeClass('hidden');
        })
        .catch((er) => {
            console.log('Error' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function SubmitPlayerEdit() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-player-edit").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    player_id: document.getElementById("player_id_edit").value,
                    username_current: document.getElementById("player_username_current").value,
                    username: document.getElementById("player_username_edit").value,
                    password: document.getElementById("player_password_edit").value,
                    phone: document.getElementById("player_phone_edit").value,
                    email: document.getElementById("player_email_edit").value,
                    role: document.getElementById("player_role_edit").value,
                    image64: _image64_single,
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

function SubmitPlayerDelete(player_id) {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $(".btn-player-delete").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    player_id: player_id
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
                    title: 'ลบข้อมูลไม่สำเร็จ!',
                    confirmButtonText: 'ตกลง'
                })

                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }
            
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                confirmButtonText: 'ตกลง',
                timer: 1000,
                timerProgressBar: true
            }).then((result) => {
                location.reload();
            })
        })
        .catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}