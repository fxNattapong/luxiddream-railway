$(document).ready(function() {
    // MODAL ADD
    $('#btn-card-add').on('click', function() {
        $('#card_image_add').attr('src', pathAssets + 'mini-logo.png');
        $('#modal-card-add').removeClass('hidden');
    });
    $('#icon-card-add-close').on('click', function() {
        var modal = $('#modal-card-add');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL EDIT
    $('.btn-card-edit').on('click', function() {
        $('#card_id_edit').val($(this).data('card_id'));
        $('#card_code_edit').val($(this).data('code'));
        $('#card_skill_edit').val($(this).data('skill'));
        $('#card_color_edit').val($(this).data('color'));
        $('#card_name_edit').val($(this).data('name'));
        $('#card_description_edit').val($(this).data('description'));
        if($(this).data('image')) {
            $('#image_edit').attr('src', $(this).data('image'));
        }

        $('#modal-card-edit').removeClass('hidden');

    });
    $('#icon-card-edit-close').on('click', function() {
        var modal = $('#modal-card-edit');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // SWEETALERT DELETE
    $('.btn-card-delete').on('click', function () {
        Swal.fire({
            title: `คุณแน่ใจหรือไม่? <br><b class="text-xl font-medium">(รหัสการ์ด: ${$(this).data('code')})</b>`,
            text: "การดำเนินการนี้ไม่สามารถเรียกคืนได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบ',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                SubmitCardDelete($(this).data('card_id'));
            }
        })
    });
});


var isLoading = false;

function SubmitCardAdd() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-card-add").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    code: document.getElementById("card_code_add").value,
                    color: document.getElementById("card_color_add").value,
                    skill: document.getElementById("card_skill_add").value,
                    name: document.getElementById("card_name_add").value,
                    description: document.getElementById("card_description_add").value,
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
                    title: 'เพิ่มข้อมูลไม่สำเร็จ!',
                    html: `${data.status}`,
                    confirmButtonText: 'ตกลง',
                })
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }
    
            Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เพิ่มข้อมูลสำเร็จ',
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

function SubmitCardEdit() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-card-edit").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    card_id: document.getElementById("card_id_edit").value,
                    code: document.getElementById("card_code_edit").value,
                    color: document.getElementById("card_color_edit").value,
                    skill: document.getElementById("card_skill_edit").value,
                    name: document.getElementById("card_name_edit").value,
                    description: document.getElementById("card_description_edit").value,
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
                    title: 'แก้ไขข้อมูลไม่สำเร็จ!',
                    html: `${data.status}`,
                    confirmButtonText: 'ตกลง',
                })
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }
    
            Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'แก้ไขข้อมูลสำเร็จ',
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

function SubmitCardDelete(card_id) {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $(".btn-card-delete").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    card_id: card_id
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