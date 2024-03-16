$(document).ready(function() {
    // MODAL ADD
    $('#btn-link-add').on('click', function() {
        $('#link_image_add').attr('src', pathAssets + 'mini-logo.png');
        $('#modal-link-add').removeClass('hidden');
    });
    $('#icon-link-add-close').on('click', function() {
        var modal = $('#modal-link-add');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL EDIT
    $('.btn-link-edit').on('click', function() {
        $('#link_id_edit').val($(this).data('link_id'));
        $('#link_type_edit').val($(this).data('type'));
        if($(this).data('image')) {
            $('#image_edit').attr('src', $(this).data('image'));
        }

        $('#modal-link-edit').removeClass('hidden');

    });
    $('#icon-link-edit-close').on('click', function() {
        var modal = $('#modal-link-edit');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // SWEETALERT DELETE
    $('.btn-link-delete').on('click', function () {
        Swal.fire({
            title: `คุณแน่ใจหรือไม่? <br><b class="text-xl font-medium">(ID: ${$(this).data('link_id')})</b>`,
            text: "การดำเนินการนี้ไม่สามารถเรียกคืนได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบ',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                SubmitLinkDelete($(this).data('link_id'));
            }
        })
    });
});


var isLoading = false;

function SubmitLinkAdd() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-link-add").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    type: document.getElementById("link_type_add").value,
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

function SubmitLinkEdit() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-link-edit").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    link_id: document.getElementById("link_id_edit").value,
                    type: document.getElementById("link_type_edit").value,
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

function SubmitLinkDelete(link_id) {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $(".btn-link-delete").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    link_id: link_id
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