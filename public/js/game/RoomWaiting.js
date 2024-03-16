$(document).ready(function() {
    // MODAL ROOM DELETE
    $('#icon-room-delete').on('click', function() {
        Swal.fire({
            title: `คุณต้องการลบห้องนี้ใช่หรือไม่?`,
            text: "การดำเนินการนี้ไม่สามารถเรียกคืนได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบ',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                RoomDelete($(this).data('room_id'));
            }
        })
    });

    // MODAL PLAYER REMOVE
    $(document).on('click', '.btn-player-remove', function () {
        Swal.fire({
            title: `คุณต้องการลบผู้เล่นนี้ใช่หรือไม่?`,
            html: `<b class="font-medium">ชื่อ: ${$(this).data('name_ingame')}</b>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบ',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                PlayerRemove($(this).data('room_id'), $(this).data('room_player_id'));
            }
        })
    });

     // MODAL PLAYER REMOVE
    $(document).on('click', '#btn-leave-room', function () {
        Swal.fire({
            title: `คุณต้องการออกจากห้องใช่หรือไม่?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                LeaveRoomWating($(this).data('room_id'));
            }
        })
    });
});

function CopyInviteCode() {
    var copyText = document.getElementById("invite_code");

    copyText.select();
    copyText.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(copyText.value);
}


var isLoading = false;

function RoomDelete(room_id){
    if(!isLoading) {
        isLoading = true;
        fetch(RouteRoomDelete, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: room_id
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
                    confirmButtonText: 'ตกลง'
                });
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }

            window.location.href = data.redirect_url;
            
        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function PlayerRemove(room_id, room_player_id){
    if(!isLoading) {
        isLoading = true;
        fetch(RoutePlayerRemove, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: room_id,
                    room_player_id: room_player_id
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
                    confirmButtonText: 'ตกลง',
                })

                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function LeaveRoomWating(room_id){
    if(!isLoading) {
        isLoading = true;
        fetch(RouteLeaveRoomWating, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: room_id,
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
                    confirmButtonText: 'ตกลง'
                });
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }

            window.location.href = data.redirect_url;
            
        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function ChangeStatus(){
    if(!isLoading) {
        isLoading = true;
        $('#loading').removeClass('hidden');
        fetch(RouteChangeStatus, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: document.getElementById("room_id").value,
                    player_id: document.getElementById("player_id").value,
                    status: document.getElementById("player_status").value,
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
                    confirmButtonText: 'ตกลง'
                });
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
            $('#loading').addClass('hidden');
        });
    }
}

var gameIsOver = false;
window.addEventListener('beforeunload', function (event) {
    if (!gameIsOver) {
        RoomDisconnect();
    }
});

function gameOver() {
    gameIsOver = true;
    window.removeEventListener('beforeunload', function (event) {
        RoomDisconnect();
    });
}

function RoomDisconnect(){
    if(!isLoading) {
        isLoading = true;
        fetch(RouteRoomDisconnect, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: document.getElementById("room_id").value,
                    player_id: document.getElementById("player_id").value,
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

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function StartGame(){
    $('#loading').removeClass('hidden');
    if(!isLoading) {
        isLoading = true;
        fetch(RouteStartGame, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: document.getElementById("room_id").value,
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
                    title: 'ไม่สามารถเริ่มเกมได้!',
                    html: `${data.status}`,
                    confirmButtonText: 'ตกลง'
                });
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }

            window.location.href = data.redirect_url;
            
        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
            $("#loading").addClass('hidden');
        });
    }
}