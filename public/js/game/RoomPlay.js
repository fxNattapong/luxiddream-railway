var $image;
var pollLinks;

const audio1 = document.getElementById('audioPlayer1');
const audio2 = document.getElementById('audioPlayer2');

audio1.addEventListener('ended', function() {
    audio2.play();
});
audio2.addEventListener('ended', function() {
    audio1.play();
});

$(document).ready(function() {
    $('#btn-leave-room').on('click', function() {
        Swal.fire({
            title: `คุณแน่ใจหรือไม่`,
            html: 'ออกจากห้อง',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                LeaveRoom();
            }
        })
    });

    // MODAL IMAGE ZOOM
    $(document).on('click', '.btn-image-zoom', function () {
        $('#image_zoom').attr('src', $(this).attr('src'));
        $("#modal-image-zoom").removeClass('hidden');
    });
    $('#icon-image-zoom-close').on('click', function () {
        var modal = $('#modal-image-zoom');
        modal.addClass("fade-out-modal");

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    $('#icon-timeup-close').on('click', function () {
        var modal = $('#modal-timeup');
        modal.addClass("fade-out-modal");

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL RESULT
    $('#btn-result').on('click', function () {
        $("#modal-result").removeClass('hidden');
    });
    $('#icon-result-close').on('click', function () {
        var modal = $('#modal-result');
        modal.addClass("fade-out-modal");

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL GAME END
    $('#btn-game-end').on('click', function () {
        $("#modal-game-end").removeClass('hidden');
    });
    $('#icon-game-end-close').on('click', function () {
        var modal = $('#modal-game-end');
        modal.addClass("fade-out-modal");

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL TIPS
    $('#btn-tips').on('click', function () {
        $("#modal-tips").removeClass('hidden');
    });
    $('#icon-tips-close').on('click', function () {
        var modal = $('#modal-tips');
        modal.addClass("fade-out-modal");

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL ACTIONS
    $('#btn-actions').on('click', function () {
        $("#modal-actions").removeClass('hidden');
    });
    $('#icon-actions-close').on('click', function () {
        var modal = $('#modal-actions');
        modal.addClass("fade-out-modal");

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL NIGHTMARE CARD
    $('.btn-link').on('click', function () {
        $('#modal_nightmare_1').attr('src', $(this).data('image_1'));
        $('#modal_nightmare_1').attr('data-nightmare_id_1', $(this).data('nightmare_id_1'));
        $('#modal_nightmare_2').attr('src', $(this).data('image_2'));
        $('#modal_nightmare_2').attr('data-nightmare_id_2', $(this).data('nightmare_id_2'));

        $("#modal-nightmare").removeClass('hidden');

        $image = $(this).find('img');
    });
    $('#icon-nightmare-close').on('click', function () {
        var modal = $('#modal-nightmare');
        modal.addClass("fade-out-modal");

        $('#modal_card_1, #modal_card_2, #modal_card_3, #modal_card_4').attr('src', pathUploads + 'element-empty.png');

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });

    // MODAL START TIMER
    $('#btn-start-countdown').on('click', function() {
        Swal.fire({
            title: `รอบที่ ${RoomRound}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'เริ่ม',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                StartTimer();
            }
        })
    });

    // MODAL END TIMER
    $('#btn-end-timer').on('click', function() {
        Swal.fire({
            title: `รอบที่ ${RoomRound}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'สิ้นสุด',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                EndTimer();
            }
        })
    });

    $('.nightmare-select').on('click', function() {
        if(!($(this).hasClass('nightmare-selected')) && ($('.nightmare-selected').length >= amtNMSelect)) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'เกิดข้อผิดพลาด!',
                html: `ไม่สามารถเลือกฝันร้ายเพิ่มได้`,
            });
        } else {
            if($('.nightmare-selected').length == 0 || $(this).hasClass('nightmare-selected')) {
                $(this).toggleClass('nightmare-selected');
                $(this).find('.circle').toggleClass('hidden');
            } else {
                var hasSelectedBefore = $(this).parent().prev().prev().find('.nightmare-selected').length > 0;
                var hasSelectedAfter = $(this).parent().next().next().find('.nightmare-selected').length > 0;
                if (hasSelectedBefore || hasSelectedAfter) {
                    $(this).toggleClass('nightmare-selected');
                    $(this).find('.circle').toggleClass('hidden');
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด!',
                        html: `ฝันร้ายต้องอยู่ติดกัน`,
                    });
                }
            }
        }
    });

    // MODAL CONFIRM NIGHTMARE FOR OPEN
    $('#btn-next-round').on('click', function() {
        Swal.fire({
            title: `เริ่มรอบถัดไป`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                StartNextRound();
            }
        })
    });

    // MODAL CONFIRM NIGHTMARE FOR OPEN
    $('#btn-next-circle').on('click', function() {
        Swal.fire({
            title: `เริ่มวงถัดไป`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                StartNextCircle();
            }
        })
    });

    // MODAL NEW ROOM
    $('#btn-new-room').on('click', function () {
        $("#modal-new-room").removeClass('hidden');
    });
    $('#icon-new-room-close').on('click', function () {
        var modal = $('#modal-new-room');
        modal.addClass("fade-out-modal");

        setTimeout(function() {
            modal.addClass('hidden');
            modal.removeClass("fade-out-modal");
        }, 500);
    });
});

var countNumber = 0;
var x = setInterval(function() {
    var now = new Date().getTime();
        
    if(Timeout) {
        var distance = Timeout - now;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        const formattedMinutes = (minutes < 10) ? '0' + minutes : minutes;
        const formattedSeconds = (seconds < 10) ? '0' + seconds : seconds;
        if(distance > 0) {
            document.getElementById("prepare-text").innerHTML = ``;
            document.getElementById("countdown_timer").innerHTML = `${formattedMinutes} : ${formattedSeconds}`;
        } else {
            if(RoomCircle == RuleCircle && RoomStatus != 0) {
                document.getElementById("countdown_timer").innerHTML = `จบเกม`;
                document.getElementById("prepare-text").innerHTML = ``;
            } else {
                document.getElementById("countdown_timer").innerHTML = `หมดเวลา`;
            }
        }
    } else {
        document.getElementById("countdown_timer").innerHTML = "00 : 00";
        
        FetchTimeout().then((result) => {
            Timeout = new Date(result).getTime();
        });
    }
    
    if(!Timeout) {
        $('#card_code_1, #card_code_2').addClass('hidden');
        document.getElementById("prepare-text").innerHTML = `เตรียมการก่อนเล่น`;
        if(isCreator) {
            $('#div-countdown_timer').addClass('hidden');
            $('#btn-start-countdown').removeClass('hidden');
        }
    }

    var showTimeUpAndResults = function() {
        $('#modal-timeup').removeClass('hidden');
        setTimeout(function() {
            $('#modal-timeup').addClass('hidden');
            $('#btn-result').click();
        }, 3000);
    };

    var showGameEndModal = function(status) {
        var imageSrc = (status == 1) ? 'ending-01-pc.gif' : 'ending-03-pc.gif';
        if (status == 1) {
            $('#you-won').removeClass('hidden');
        } else {
            $('#you-lost').removeClass('hidden');
        }
        
        $('#image_game_end').attr('src', pathAssets + 'web_based_board_game/' + imageSrc);
        $('#btn-game-end').removeClass('hidden');
        $('#modal-timeup').removeClass('hidden');
        setTimeout(function() {
            $('#modal-timeup').addClass('hidden');
            $('#modal-game-end').removeClass('hidden');
        }, 3000);
        $('#btn-result-final').removeClass('hidden');
    };

    var GameEndAndUpdateStats = function() {
        if(isCreator) {
            UpdateStats();
        }
        GameEnd()
            .then(status => {
                showGameEndModal(status);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };

    var showButtonAndNmSelect = function() {
        $('#btn-next-circle').removeClass('hidden');
        $('.nm_image').removeClass('btn-image-zoom').off('click');
        $('#modal-image-zoom').addClass('hidden');
        $('.nightmare-select').removeClass('hidden');
    };

    var CheckLinksAndHiddenNM = function() {
        var isLinkBeforeCalm;
        var isLinkAfterCalm;
        $('.nightmare-select').each(function() {
            isLinkBeforeCalm = $(this).parent().prev().find('.div_link').prevObject.data('link_status');
            isLinkAfterCalm = $(this).parent().next().find('.div_link').prevObject.data('link_status');
            if(isLinkBeforeCalm != 1 && isLinkAfterCalm != 1) {
                $(this).addClass('hidden');
            }
        });
    };

    async function runCheckNmSelect() {
        await showButtonAndNmSelect();
        CheckLinksAndHiddenNM();
    }
    
    // TIMEOUT
    var amtLinks = (amtNMSelect == 1) ? 5 : 6;
    var links_calm;
    if (distance < 0) {
        $('#div-countdown_timer').removeClass('hidden');
        $('#card_code_1, #card_code_2').addClass('hidden');
        $("#btn-timeout").addClass('hidden');
        $("#btn-end-timer").addClass('hidden');

        pollLinksCalm(room_id)
            .then(links_calm => {
                if (countNumber == 0) {
                    if (RoomCircle == RuleCircle) {
                        $('#loading').removeClass('hidden');
                        if(RoomRound == RuleRound && RoomStatus == 0) {
                            GameEndAndUpdateStats();
                        } else if (RoomStatus != 0) {
                            showGameEndModal(RoomStatus);
                        } else {
                            $('#btn-next-round').removeClass('hidden');
                            showTimeUpAndResults();
                        }
                    } else {
                        showTimeUpAndResults();
                    }
                    
                    if(isCreator) {
                        if(links_calm < 3) {
                            $('#btn-next-round').removeClass('hidden');
                        } else {
                            if(RoomCircle == RuleCircle || RoomStatus != 0) {
                                $('#btn-new-room').removeClass('hidden');
                            } else {
                                runCheckNmSelect();
                            }
                        }
                    }
                }
                $('#loading').addClass('hidden');
                countNumber++;
            })
            .catch(error => {
                console.error('Error:', error);
            });
          
    } else if(distance > 0) {
        $('#card_code_1, #card_code_2').removeClass('hidden');
        if(isCreator) {
            pollLinksCalm(room_id)
                .then(links_calm => {
                    if (RoomCircle == RuleCircle && links_calm  == amtLinks) {
                        $('#btn-end-timer').removeClass('hidden');
                    } else if (RoomCircle != RuleCircle) {
                        if(links_calm >= 3) {
                            $('#btn-end-timer').removeClass('hidden');
                        } 
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
}, 1000);

document.addEventListener('DOMContentLoaded', function () {
    $('#loading').addClass('hidden');
    pollLinks(room_id);
});

function pollLinks(room_id){
    pollLinks = setInterval(() => {
        fetch(RoutePollLinks, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: room_id,
                    circle: RoomCircle
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
            console.log('data:', data);
            if(data.room.circle != RoomCircle || data.room.round != RoomRound || data.room.status != RoomStatus) {
                window.location.reload();
            }
            if(data.room.time != Timeout) {
                Timeout = new Date(data.room.time).getTime();
            }

            var link_calm = 0;
            data.links.forEach(link => {
                if (link.room_link_status === 1) {
                    link_calm++;
                }
            });

            var amtLinks = (amtNMSelect == 1) ? 5 : 6;
            if(link_calm === amtLinks) {
                var now = new Date().getTime();
                var distance = Timeout - now;
                if(distance > 0) {
                    $('#btn-end-timer').removeClass('hidden');
                }
            }

            $('.link_image').each(function(index) {
                var newSource = data.links[index].link_image;
                $(this).attr('src', pathUploads + newSource);
            });

        })
        .catch((er) => {
            console.log('Error' + er);
        });
    }, 1000);
}

function pollLinksCalm(room_id){
    return fetch(RoutePollLinks, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body:JSON.stringify(
            {
                room_id: room_id,
                circle: RoomCircle,
                status: 1
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
        console.log('data:', data);

        return data.links.length;
    })
    .catch((er) => {
        console.log('Error' + er);
    });
}

var isLoading = false;

function LeaveRoom(){
    fetch(RouteLeaveRoom, {
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
            });

            const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
            return Promise.reject(error);
        }

        window.location.href = data.redirect_url;
        
    }).catch((er) => {
        console.log('Error: ' + er);
    })
}

function StartTimer(){
    if(!isLoading) {
        isLoading = true;
        fetch(RouteStartTimer, {
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
                    title: 'เกิดข้อผิดพลาด!',
                    html: `${data.status}`,
                });
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }

            Timeout = new Date(data.round_time).getTime();
            $('#btn-start-countdown').addClass('hidden');

            $('#div-countdown_timer').removeClass('hidden');

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function EndTimer(){
    if(!isLoading) {
        isLoading = true;
        fetch(RouteEndTimer, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: document.getElementById("room_id").value,
                    circle: RoomCircle
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

            Timeout = new Date(data.round_time).getTime();
            $('#btn-end-timer').addClass('hidden');

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function FetchTimeout(){
    if(!isLoading) {
        isLoading = true;
        return fetch(RouteFetchTimeout, {
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
                    title: 'เกิดข้อผิดพลาด!',
                    html: `${data.status}`,
                });
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }

            return data.room.time;

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function FetchCards(element){
    var $image = $(element).next('div').find('img');
    if(!isLoading) {
        isLoading = true;
        fetch(RouteFetchCards, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_link_id: $(element).data('room_link_id'),
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
                    title: 'แจ้งเตือน!',
                    html: `${data.status}`,
                });
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }
            console.log(data);

            $('#modal_link').attr('src', pathUploads + data.room_link.link_image);
            $('#modal_link').attr('data-room_link_id', data.room_link.room_link_id);

            if (data.cards) {
                for (var i = 0; i < Math.min(data.cards.length, 4); i++) {
                    var card = data.cards[i];
                    var targetElements = ['#modal_card_1', '#modal_card_2', '#modal_card_3', '#modal_card_4'];
                    var targetElement = $(targetElements[card.position]);
                    targetElement.attr('src', pathUploads + card.card_image);
                }
            }

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function FetchResults(){
    if(!isLoading) {
        isLoading = true;
        fetch(RouteFetchResults, {
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
                    title: 'แจ้งเตือน!',
                    html: `${data.status}`,
                });
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }
            console.log(data);

            $('#alls-items').empty();
            if(data.links_all.length) {
                for (let i = data.links_all.length - 1; i >= 0; i--) {
                    var _newBox = $('#linkBoxPt').clone();
                    _newBox.removeClass('hidden');
                    _newBox.attr('id', 'boxNo' + data.links_all[i].room_link_id);
                    _newBox.find('.modal_link_image').attr('src', pathUploads + data.links_all[i].link_image);
                    _newBox.find('.circleText').text(data.links_all[i].circle);

                    for(let j=0; j<data.links_all[i].cards_items.length; j++) {
                        _newBox.find('.modal_card_' + j).attr('src', pathUploads + data.links_all[i].cards_items[j].card_image);
                    }

                    $('#alls-items').append(_newBox);
                }
            } else {
                var _newBox = $('.noItems').clone();
                _newBox.removeClass('hidden');
                $('#alls-items').append(_newBox);
            }

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function CardAdd(element){
    if(!isLoading) {
        isLoading = true;
        fetch(RouteCardAdd, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    nightmare_id_1: document.getElementById("modal_nightmare_1").dataset.nightmare_id_1,
                    room_link_id: document.getElementById("modal_link").dataset.room_link_id,
                    nightmare_id_2: document.getElementById("modal_nightmare_2").dataset.nightmare_id_2,
                    card_code: $("#" + ($(element).data('button_input') === 'nm_left' ? "card_code_1" : "card_code_2")).val(),
                    from_nm: $(element).data('button_input') === 'nm_left' ? 'left' : 'right',
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
            console.log(data);

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'เพิ่มการ์ดสำเร็จ!',
                timer: 1000,
                timerProgressBar: true
            });

            $('#card_code').val('');

            var targetElements = ['#modal_card_1', '#modal_card_2', '#modal_card_3', '#modal_card_4'];
            var targetElement = $(targetElements[data.card.position]);
            targetElement.attr('src', pathUploads + data.card.card_image);
            if(data.cards.length === 4) {
                isLoading = false;
                CheckNightmareLink();
            }

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function CheckNightmareLink(){
    if(!isLoading) {
        isLoading = true;
        fetch(RouteCheckNightmareLink, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: room_id,
                    room_link_id: document.getElementById("modal_link").dataset.room_link_id,
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
            console.log(data);

            $('#modal_link').attr('src', pathUploads + data.room_link.link_image);
            $image.attr('src', pathUploads + data.room_link.link_image);
            $image.parent().parent().parent().attr('data-link_status', data.room_link.status);

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function StartNextRound(){
    if(!isLoading) {
        isLoading = true;
        fetch(RouteStartNextRound, {
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
                    title: 'เกิดข้อผิดพลาด!',
                    html: `${data.status}`,
                });
    
                const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                return Promise.reject(error);
            }

            Timeout = new Date(data.time).getTime();
            $('#btn-start-countdown').addClass('hidden');

            $('#round-text').text(data.round);

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
        });
    }
}

function StartNextCircle(){
    var selectedIds = $('.nightmare-selected').map(function() {
        return $(this).data('room_nightmare_id');
    }).get();

    $('#loading').removeClass('hidden');

    if(!isLoading) {
        isLoading = true;
        fetch(RouteStartNextCircle, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-Token": csrfToken
            },
            body:JSON.stringify(
                {
                    room_id: room_id,
                    nm_selected_ids: selectedIds,
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
            console.log(data);

            window.location.reload();

        }).catch((er) => {
            console.log('Error: ' + er);
        })
        .finally(() => {
            isLoading = false;
            $('#loading').addClass('hidden');
        });
    }
}

function GameEnd(){
    var linksStatus = $('.btn-link').map(function() {
        return $(this).data('link_status');
    }).get();

    var countStatus = 0;
    linksStatus.forEach(function(status) {
        if (status === 1) {
            countStatus++;
        }
    });

    return fetch(RouteGameEnd, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body:JSON.stringify(
            {
                room_id: room_id,
                linksStatus: linksStatus,
                countStatus: countStatus,
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
        console.log(data);
        
        return data.status;
    }).catch((er) => {
        console.log('Error: ' + er);
    })
}

function UpdateStats(){
    fetch(RouteUpdateStats, {
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
            });

            const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
            return Promise.reject(error);
        }

        console.log(data);
        
    }).catch((er) => {
        console.log('Error: ' + er);
    })
}


let currentGoalIndex = 1;
const totalGoals = 3;
if (currentGoalIndex == 1) {
    document.getElementById('btn-prev-goal').classList.add('hidden');
}
function showNextGoal() {
    if (currentGoalIndex < totalGoals) {
        document.getElementById(`goal-${currentGoalIndex}`).classList.add('hidden');
        currentGoalIndex++;
        document.getElementById(`goal-${currentGoalIndex}`).classList.remove('hidden');
        document.getElementById('btn-prev-goal').classList.remove('hidden');
        
        if (currentGoalIndex == totalGoals) {
            document.getElementById('btn-next-goal').classList.add('hidden');
        }
    }
}

function showPrevGoal() {
    if (currentGoalIndex > 1) {
        document.getElementById(`goal-${currentGoalIndex}`).classList.add('hidden');
        currentGoalIndex--;
        document.getElementById(`goal-${currentGoalIndex}`).classList.remove('hidden');
        document.getElementById('btn-next-goal').classList.remove('hidden');

        if (currentGoalIndex == 1) {
            document.getElementById('btn-prev-goal').classList.add('hidden');
        }
    }
}

function showActionDetails(actionNumber) {
    document.getElementById('icon-actions-back').classList.remove('hidden');

    document.querySelectorAll('[id^="action-details-"]').forEach(function(element) {
        element.classList.add('hidden');
    });

    document.getElementById(`action-details-${actionNumber}`).classList.remove('hidden');
    document.getElementById('actions-all').classList.add('hidden');
    
    if (actionNumber == '2-1') {
        document.querySelectorAll('.btn-prev-2\\.1').forEach(function(btnPrev) {
            btnPrev.classList.add('hidden');
        });
        document.querySelectorAll('.btn-next-2\\.2').forEach(function(btnNext) {
            btnNext.classList.remove('hidden');
        });
    } else {
        document.querySelectorAll('.btn-prev-2\\.1').forEach(function(btnPrev) {
            btnPrev.classList.remove('hidden');
        });
        document.querySelectorAll('.btn-next-2\\.2').forEach(function(btnNext) {
            btnNext.classList.add('hidden');
        });
    }

    if (actionNumber == '3-1') {
        document.querySelectorAll('.btn-prev-3\\.1').forEach(function(btnPrev) {
            btnPrev.classList.add('hidden');
        });
        document.querySelectorAll('.btn-next-3\\.2').forEach(function(btnNext) {
            btnNext.classList.remove('hidden');
        });
    } else {
        document.querySelectorAll('.btn-prev-3\\.1').forEach(function(btnPrev) {
            btnPrev.classList.remove('hidden');
        });
        document.querySelectorAll('.btn-next-3\\.2').forEach(function(btnNext) {
            btnNext.classList.add('hidden');
        });
    }
}

function showActionsAll() {
    document.getElementById('icon-actions-back').classList.add('hidden');

    document.querySelectorAll('[id^="action-details-"]').forEach(function(element) {
        element.classList.add('hidden');
    });
    document.getElementById('actions-all').classList.remove('hidden');
}