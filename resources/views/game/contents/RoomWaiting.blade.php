<title>Room Waiting</title>

@extends('game.layouts.Layout')

@section('Content')
    <div class="flex-col flex items-center justify-center mt-[5em]">
        <!-- START LOGO -->
        <div class="z-50 w-[275px] absolute">
            <img src="{{ URL('assets/web_based_board_game/element-16.png') }}" alt="">
        </div>
        <!-- END LOGO -->

        <!-- START CONTENT -->
        <div class="flex-col flex items-center justify-center">
            <div class="z-[100] grid grid-cols-3 gap-8">
                <!-- START INVITE -->
                <div class="z-50 w-[350px] mx-auto max-lg:col-span-3">
                    <div class="z-50 relative flex-col flex items-center justify-center w-full border border-gray-300 p-8 rounded-3xl space-y-[1em] overflow-hidden max-lg:py-4">
                        <div class="z-10 w-full h-full absolute top-0 left-0 bg-[#4A4098] opacity-50"></div>
                        @if(Session::get('creator'))
                            <span id="icon-room-delete" class="z-20 absolute top-[-30px] right-0 m-0 mr-3 text-white text-[30px] font-medium hover:text-indigo-300 cursor-pointer duration-300"
                            data-room_id="{{ $room->room_id }}">&times;</span>
                        @endif
                        <div class="z-20 relative flex-col flex items-center space-y-[2em]">
                            <div class="flex-col gap-2 text-center">
                                <h1 class="text-white text-3xl">รหัสเชิญ</h1>
                                <span class="text-white">ระดับ: 
                                    @if($room->level === 0)
                                        ง่าย
                                    @elseif($room->level === 1)
                                        ปานกลาง
                                    @elseif($room->level === 2)
                                        ยาก
                                    @endif
                                </span>
                                <span class="text-white">จำนวน: {{ $room->level_round }} รอบ</span>
                            </div>
                            <div class="w-full grid grid-cols-3 gap-2">
                                <input id="room_id" type="hidden">
                                <input id="player_id" type="hidden">
                                <input id="invite_code" type="text" class="col-span-2 w-full rounded-full bg-indigo-200 border border-white placeholder-white px-2 py-1 cursor-default" value="{{ $room->invite_code }}" readonly>
                                <button onclick="CopyInviteCode()" class="bg-[#4A3F98] rounded-full py-1 w-full border border-white text-white hover:bg-[#3e3877] duration-300">คัดลอก</button>
                            </div>
                            @if(Session::get('creator'))
                                <div onclick="StartGame()" class="z-[20] bg-[#8A66A7] rounded-full py-1 w-full border border-white text-white text-center cursor-pointer hover:bg-[#6e4f88] duration-300">เริ่มเกม</div>
                            @endif
                            @if(Session::get('player'))
                            <div class="w-full space-y-2">
                                <div>
                                    <input id="player_status" type="hidden">
                                    <button onclick="ChangeStatus()" id="btn-status" class="bg-[#53b46f] rounded-full py-1 w-full border border-white text-white hover:bg-[#309951] duration-300">พร้อม</button>
                                </div>
                                <div>
                                    <input id="player_status" type="hidden">
                                    <button id="btn-leave-room" class="bg-[#E69FBC] rounded-full py-1 w-full border border-white text-white hover:bg-[#df87a9] duration-300"
                                    data-room_id="{{ $room->room_id }}">ออกจากห้อง</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- END INVITE -->

                <!-- START PLAYER -->
                <div id="grid-players" class="z-50 relative w-full min-h-[76px] border border-gray-300 rounded-3xl p-2 col-span-2 grid grid-cols-2 max-lg:grid-cols-1 max-lg:col-span-3 max-lg:mx-auto max-lg:mt-[1em]">
                    <div class="z-10 w-full h-full absolute top-0 left-0 bg-[#4A4098] opacity-50 rounded-3xl"></div>
                    <div class="absolute right-0 mt-[-40px]">
                        <span class="flex items-center px-2 py-1 font-light text-gray-50 bg-gray-400 rounded-3xl whitespace-nowrap">
                            <i class='bx bx-user text-xl'></i>&nbsp;
                            <span class="number_player">สูงสุด {{ $room->amount }}</span>&nbsp;ผู้เล่น
                        </span>
                    </div>

                    <div id="loading" class="z-[500] absolute top-0 left-0 w-full h-full">
                        <div class="absolute top-0 left-0 bg-gray-50 w-full h-full opacity-20 rounded-3xl"></div>
                        <div class="w-full h-full flex items-center justify-center">
                            <svg aria-hidden="true" class="w-10 h-10 max-md:w-7 max-md:h-7 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                        </div>
                        <span class="sr-only">Loading...</span>
                    </div>

                </div>
                <!-- END PLAYER -->
            </div>
        </div>
        <!-- END CONTENT -->
    </div>

    <!-- START PROTOTYPES -->
    <div class="z-10 w-full h-full absolute top-0 left-0 bg-[#4A4098] opacity-50 rounded-3xl hidden bg-set-opacity"></div>

    <div class="absolute right-0 mt-[-40px] hidden NumberPlayerBoxPt">
        <span class="flex items-center px-2 py-1 font-light text-gray-50 bg-gray-400 rounded-3xl whitespace-nowrap">
            <i class='bx bx-user text-xl'></i>&nbsp;สูงสุด&nbsp;
            <span class="number_player">{{ $room->amount }}</span>&nbsp;ผู้เล่น
        </span>
    </div>

    <div class="z-20 relative border-[3px] border-dashed rounded-full m-1 h-fit px-4 py-2 overflow-hidden hidden PlayerBoxPt">
        <div class="relative inline-flex items-center w-full whitespace-nowrap">
            @if(Session::get('creator'))
                <span class="btn-player-remove z-20 absolute top-[-7px] left-0 m-0 text-white text-[30px] font-medium hover:text-red-400 cursor-pointer duration-300">&times;</span>
            @endif
            <div class="flex items-center gap-2 ml-4">
                <i class='bx bxs-user text-2xl text-white' ></i>
                <input type="text" class="hidden player_id">
                <span class="player_name text-[18px] font-bold text-white">name</span>
            </div>
            <span class="span-status-color w-[20px] h-[20px] rounded-full ml-auto mr-0 bg-[#FD0000]"></span>
            <span class="span-creator hidden text-indigo-900 bg-indigo-300 px-2 rounded-full ml-auto mr-0">ผู้สร้าง</span>
        </div>
    </div>
    <!-- END PROTOTYPES -->
    
@endsection

@push('script')
    <script src="{{ URL('js/game/RoomWaiting.js') }}" defer></script>
    <script>
        const RouteHome = "<?php echo Route('Home'); ?>";
        const RouteRoomDelete = "<?php echo Route('RoomDelete'); ?>";
        const RoutePlayerRemove = "<?php echo Route('PlayerRemove'); ?>";
        const RouteLeaveRoomWating = "<?php echo Route('LeaveRoomWating'); ?>";
        const RoutePollPlayers = "<?php echo Route('pollPlayers'); ?>";
        const RouteChangeStatus = "<?php echo Route('ChangeStatus'); ?>";
        const RouteRoomDisconnect = "<?php echo Route('RoomDisconnect'); ?>";
        const RouteStartGame = "<?php echo Route('StartGame'); ?>";
        const creatorName = '<?php echo $room->creator_name ?>';
        const room_id = "<?php echo $room->room_id ?>";

        document.addEventListener('DOMContentLoaded', function () {
            $('#loading').addClass('hidden');

            @if($players && !empty($players)) 
                pollPlayers(room_id);
            @endif
        });

        $(document).ready(function() {
            $('#room_id').val(room_id);
        });


        function pollPlayers(room_id){
            setInterval(() => {
                fetch(RoutePollPlayers, {
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
                        const error = (data && data.errorMessage) || "{{trans('general.warning.system_failed')}}" + " (CODE:"+response.status+")";
                        return Promise.reject(error);
                    }

                    console.log('data:', data);
                    if(data.status === 'error') {
                        window.location.href = data.redirect_url;
                    }

                    if(data.room.round !== 0) {
                        window.location.href = data.redirect_url;
                    }
                    
                    $('#grid-players').empty();
                    var BgBox = $('.bg-set-opacity').clone();
                    BgBox.removeClass("hidden");
                    $("#grid-players").append(BgBox);

                    var NumberPlayerBox = $('.NumberPlayerBoxPt').clone();
                    NumberPlayerBox.removeClass("hidden");
                    // NumberPlayerBox.find('.number_player').text(data.players.length);
                    $("#grid-players").append(NumberPlayerBox);

                    if(data.players.length > 0) {
                        for(let i=0; i<data.players.length; i++) {
                            var PlayerBox = $('.PlayerBoxPt').clone();
                            PlayerBox.removeClass("hidden PlayerBoxPt");
                            PlayerBox.find('.btn-player-remove').attr('data-room_player_id', data.players[i].room_player_id);
                            PlayerBox.find('.btn-player-remove').attr('data-name_ingame', data.players[i].name_ingame);
                            PlayerBox.find('.btn-player-remove').attr('data-room_id', data.room.room_id);
                            PlayerBox.find('.player_id').val(data.players[i].player_id);
                            PlayerBox.find('.player_name').text(data.players[i].name_ingame);

                            if(data.players[i].username !== creatorName) {
                                if(data.players[i].status === 0) {
                                    PlayerBox.find('.span-status-color').removeClass('bg-[#FD0000]').addClass('bg-[#FD0000]');
                                } else if(data.players[i].status === 1) {
                                    PlayerBox.find('.span-status-color').removeClass('bg-[#FD0000]').addClass('bg-[#50D255]');
                                } else if(data.players[i].status === 2) {
                                    PlayerBox.find('.span-status-color').removeClass('bg-[#FD0000]').addClass('bg-gray-300');
                                }
                            }
                            $('#player_id').val(sessionPlayerID);
                            if(data.players[i].username === creatorName) {
                                PlayerBox.find('.span-status-color').removeClass('span-status-color w-[20px] h-[20px]')
                                                                    .addClass('text-indigo-900 bg-indigo-300 px-2')
                                                                    .text('ผู้สร้าง');
                                PlayerBox.find('.btn-player-remove').remove();
                                // $('#player_id').val(data.players[i].player_id);
                            } else if(data.players[i].name_ingame === sessionName) {
                                if(data.players[i].status === 0) {
                                    PlayerBox.find('.span-status-color').removeClass('w-[20px] h-[20px]')
                                                                        .addClass('bg-[#FD0000] text-white px-2')
                                                                        .text('คุณ');
                                    // $('#player_id').val(data.players[i].player_id);
                                    $('#player_status').val(0);
                                    $('#btn-status').text('พร้อม').removeClass('bg-[#ff5757] hover:bg-[#fd0000]')
                                                                    .addClass('bg-[#E69FBC] hover:bg-[#d1638a]');
                                } else {
                                    PlayerBox.find('.span-status-color').removeClass('w-[20px] h-[20px]')
                                                                        .addClass('bg-[#50D255] text-white px-2')
                                                                        .text('คุณ');
                                    // $('#player_id').val(data.players[i].player_id);
                                    $('#player_status').val(1);
                                    $('#btn-status').text('ไม่พร้อม').removeClass('bg-[#E69FBC] hover:bg-[#d1638a]')
                                                                        .addClass('bg-[#ff5757] hover:bg-[#fd0000]');
                                }
                            } else {
                                if(data.players[i].status === 0) {
                                    PlayerBox.find('.span-status-color').addClass('bg-[#FD0000] text-white px-2');
                                    // $('#player_id').val(data.players[i].player_id);
                                    $('#player_status').val(0);
                                    $('#btn-status').text('พร้อม').removeClass('bg-[#ff5757] hover:bg-[#fd0000]')
                                                                    .addClass('bg-[#E69FBC] hover:bg-[#d1638a]');
                                } else {
                                    PlayerBox.find('.span-status-color').addClass('bg-[#50D255] text-indigo-900 px-2'); 
                                    // $('#player_id').val(data.players[i].player_id);      
                                    $('#player_status').val(1);
                                    $('#btn-status').text('ไม่พร้อม').removeClass('bg-[#E69FBC] hover:bg-[#d1638a]')
                                                                        .addClass('bg-[#ff5757] hover:bg-[#fd0000]');
                                }
                            }
                            

                            $("#grid-players").append(PlayerBox);
                        }
                    }

                })
                .catch((er) => {
                    console.log('Error' + er);
                });
            }, 1000);
        }
        
    </script>
@endpush