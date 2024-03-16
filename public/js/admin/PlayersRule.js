$(document).ready(function() {
    $('#player_rule_amount_add').on('change', function() {
        var selectedValue = parseInt($(this).val());
        if(selectedValue === 4) {
            $('#player_rule_circle_add').val('2');
            $('#nightmare_5_add').val('1');
            $('#nightmare_6_add').val('1');
        } else if(selectedValue === 5) {
            $('#player_rule_circle_add').val('3');
            $('#nightmare_5_add').val('3');
            $('#nightmare_6_add').val('0');
        } else if(selectedValue === 6) {
            $('#player_rule_circle_add').val('3');
            $('#nightmare_5_add').val('2');
            $('#nightmare_6_add').val('1');
        } else if(selectedValue === 7) {
            $('#player_rule_circle_add').val('4');
            $('#nightmare_5_add').val('3');
            $('#nightmare_6_add').val('1');
        } else if(selectedValue === 8) {
            $('#player_rule_circle_add').val('4');
            $('#nightmare_5_add').val('2');
            $('#nightmare_6_add').val('2');
        }
    });
    
    // MODAL ADD
    $('#btn-player-rule-add').on('click', function() {
        $('#modal-player-rule-add').removeClass('hidden');
    });
    $('#icon-player-rule-add-close').on('click', function() {
        var modal = $('#modal-player-rule-add');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL EDIT
    $('.btn-player-rule-edit').on('click', function() {
        $('#player_rule_id_edit').val($(this).data('player_rule_id'));
        $('#amount_edit').val($(this).data('amount'));
        $('#circle_edit').val($(this).data('circle'));
        $('#nightmare_5_edit').val($(this).data('nightmare_5'));
        $('#nightmare_6_edit').val($(this).data('nightmare_6'));

        $('#modal-player-rule-edit').removeClass('hidden');

    });
    $('#icon-player-rule-edit-close').on('click', function() {
        var modal = $('#modal-player-rule-edit');
        modal.addClass('fade-out-modal');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // SWEETALERT DELETE
    $('.btn-player-rule-delete').on('click', function () {
        Swal.fire({
            title: `คุณแน่ใจหรือไม่? <br><b class="text-xl font-medium">(จำนวนผู้เล่น: ${$(this).data('amount')})</b>`,
            text: "การดำเนินการนี้ไม่สามารถเรียกคืนได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบ',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                SubmitPlayerRuleDelete($(this).data('player_rule_id'));
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

function SubmitPlayerRuleAdd() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-player-rule-add").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify({
                amount: document.getElementById("player_rule_amount_add").value,
                circle: document.getElementById("player_rule_circle_add").value,
                nightmare_5: document.getElementById("nightmare_5_add").value,
                nightmare_6: document.getElementById("nightmare_6_add").value
            })
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

function SubmitPlayerRuleEdit() {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $("#form-player-rule-edit").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    player_rule_id: document.getElementById("player_rule_id_edit").value,
                    amount: document.getElementById("amount_edit").value,
                    circle: document.getElementById("circle_edit").value,
                    nightmare_5: document.getElementById("nightmare_5_edit").value,
                    nightmare_6: document.getElementById("nightmare_6_edit").value
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

function SubmitPlayerRuleDelete(player_rule_id) {
    if(!isLoading) {
        isLoading = true;
        var RouteURL = $(".btn-player-rule-delete").data("route");
        fetch(RouteURL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    player_rule_id: player_rule_id
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