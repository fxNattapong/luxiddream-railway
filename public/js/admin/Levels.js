$(document).ready(function() {
    $('#level_add').on('change', function() {
        var selectedValue = parseInt($(this).val());
        if(selectedValue === 0) {
            $('#level_round_add').val('5');
            $('#time_1_add').val('7.00');
            $('#time_2_add').val('6.00');
            $('#time_3_add').val('5.00');
            $('#time_4_add').val('4.00');
            $('#time_5_add').val('3.30').parent().removeClass('hidden');
        } else if(selectedValue === 1) {
            $('#level_round_add').val('4');
            $('#time_1_add').val('7.00');
            $('#time_2_add').val('6.30');
            $('#time_3_add').val('6.00');
            $('#time_4_add').val('4.00');
            $('#time_5_add').parent().addClass('hidden');
        } else if(selectedValue === 2) {
            $('#level_round_add').val('4');
            $('#time_1_add').val('6.00');
            $('#time_2_add').val('4.00');
            $('#time_3_add').val('3.30');
            $('#time_4_add').val('3.00');
            $('#time_5_add').parent().addClass('hidden');
        }
    });
    
    // MODAL ADD
    $('#btn-level-add').on('click', function() {
        $('#modal-level-add').removeClass('hidden');
    });
    $('#icon-level-add-close').on('click', function() {
        var modal = $('#modal-level-add');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL EDIT
    $('.btn-level-edit').on('click', function() {
        $('#level_id_edit').val($(this).data('level_id'));
        $('#level_edit').val($(this).data('level'));
        $('#round_edit').val($(this).data('round'));
        $('#time_1_edit').val($(this).data('time_1'));
        $('#time_2_edit').val($(this).data('time_2'));
        $('#time_3_edit').val($(this).data('time_3'));
        $('#time_4_edit').val($(this).data('time_4'));

        var time_5 = parseInt($(this).data('time_5'));
        if(time_5) {
            $('#time_5_edit').parent().removeClass('hidden');
            $('#time_5_edit').val($(this).data('time_5'));
        } else {
            $('#time_5_edit').parent().addClass('hidden');
        }

        $('#modal-level-edit').removeClass('hidden');

    });
    $('#icon-level-edit-close').on('click', function() {
        var modal = $('#modal-level-edit');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // SWEETALERT DELETE
    $('.btn-level-delete').on('click', function () {
        var level = parseInt($(this).data('level'));
        if(level === 0) {
            var text_level = 'ง่าย';
        } else if (level === 1) {
            var text_level = 'ปานกลาง';
        } else {
            var text_level = 'ยาก';
        }

        Swal.fire({
            title: `คุณแน่ใจหรือไม่? <br><b class="text-xl font-medium">(ระดับ: ${text_level})</b>`,
            text: "การดำเนินการนี้ไม่สามารถเรียกคืนได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบ',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                SubmitLevelDelete($(this).data('level_id'));
            }
        })
    });
});


var isLoading = false;

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

function SubmitLevelAdd() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-level-add").data("route");

        var requestBody = {
            level: document.getElementById("level_add").value,
            round: document.getElementById("level_round_add").value,
            time_1: document.getElementById("time_1_add").value,
            time_2: document.getElementById("time_2_add").value,
            time_3: document.getElementById("time_3_add").value,
            time_4: document.getElementById("time_4_add").value
        };
        
        var time5Element = document.getElementById("time_5_add");
        var parentDiv = time5Element.parentElement;
        if (!parentDiv.classList.contains("hidden")) {
            requestBody.time_5 = time5Element.value;
        }

        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(requestBody)
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

function SubmitLevelEdit() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-level-edit").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    level_id: document.getElementById("level_id_edit").value,
                    level: document.getElementById("level_edit").value,
                    round: document.getElementById("level_round_edit").value,
                    time_1: document.getElementById("time_1_edit").value,
                    time_2: document.getElementById("time_2_edit").value,
                    time_3: document.getElementById("time_3_edit").value,
                    time_4: document.getElementById("time_4_edit").value
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

function SubmitLevelDelete(level_id) {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $(".btn-level-delete").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    level_id: level_id
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