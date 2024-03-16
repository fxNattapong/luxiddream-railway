<title>Room Play</title>

@extends('game.layouts.Layout')

@section('Content')

    <!-- START CONTENT -->
    <div class="flex-col flex items-center justify-center">
        <audio id="audioPlayer1" autoplay loop>
            <source src="{{ URL('/assets/web_based_board_game/music-01.mp3') }}" type="audio/mp3">
            Your browser does not support the audio element.
        </audio>

        <audio id="audioPlayer2" loop>
            <source src="{{ URL('/assets/web_based_board_game/music-02.mp3') }}" type="audio/mp3">
            Your browser does not support the audio element.
        </audio>

        <h1 class="z-[100] text-white text-2xl font-bold">
            <span id="prepare-text"></span> รอบที่ <span id="round-text">{{ $room->round }}</span> / {{ $room->level_round}}
        </h1>
        <input id="room_id" type="hidden" value="{{ $room->room_id }}">

        <!-- START CIRCLE -->
        @if(count($room_nightmares) == 5)
        <div class="z-50 relative w-[400px] max-sm:w-full h-[400px] overflow-hidden">
        @else
        <div class="z-50 relative w-[400px] max-sm:w-full h-[450px] overflow-hidden">
        @endif
            <div class="z-50 flex justify-center items-center h-full">
                <h1 class="z-[101] absolute top-2 left-2 text-white text- font-medium bg-[#EE609A] rounded-full px-2 py-1">{{ $room->invite_code }}</h1>
                <h1 class="z-[101] absolute top-2 right-2 text-white text- font-medium bg-indigo-900 rounded-full px-2 py-1">วงที่ {{ $room->circle }} / {{ $room->rule_circle }}</h1>
                <div class="z-10 w-full h-full absolute top-0 left-0 bg-indigo-100 opacity-50"></div>

                <!-- START NIGHTMARE CARD -->
                @if(count($room_nightmares) == 5)
                <div class="mt-[-35px] w-[300px] h-[300px] flex justify-center items-center relative">
                @else
                <div class="mt-[25px] w-[300px] h-[300px] flex justify-center items-center relative">
                @endif

                    <!-- START TIMER -->
                    <div class="z-50 w-full h-full flex">
                        <div class="w-fit m-auto text-center flex-col flex justify-center items-center">
                            <h1 class="text-xl text-white font-bold uppercase">สิ้นสุดใน:</h1>
    
                            <div id="div-countdown_timer" class="relative mx-auto w-[100px] h-fit p-3 rounded-full overflow-hidden text-center">
                                <div class="z-10 w-full h-full absolute top-0 left-0 bg-white opacity-50"></div>
                                <span id="countdown_timer" class="z-20 relative text-[#EE609A] text-xl font-bold whitespace-nowrap">00 : 00</span>
                            </div>
    
                            @if(Session::get('creator'))
                                <div class="w-[75px]">
                                    <div id="btn-start-countdown" class="hidden bg-[#EE609A] rounded-full py-1.5 px-2 w-full border border-white text-white text-center hover:bg-[#d62c65] duration-300 cursor-pointer">เริ่ม</div>
                                </div>

                                <button id="btn-timeout" class="hidden z-[100] mt-2 bg-[#EE609A] hover:bg-[#d62c65] rounded-full py-1 px-1.5 w-[60px] border border-white text-white text-center text-sm whitespace-nowrap duration-300">จบรอบ</button>

                                <button id="btn-end-timer" class="hidden z-[100] mt-2 bg-[#EE609A] hover:bg-[#d62c65] rounded-full py-1 px-1.5 w-[60px] border border-white text-white text-center text-sm whitespace-nowrap duration-300">สิ้นสุด</button>

                                <button id="btn-next-circle" class="hidden z-[100] mt-2 bg-[#EE609A] hover:bg-[#d62c65] rounded-full py-1 px-1.5 w-[60px] border border-white text-white text-center text-sm whitespace-nowrap duration-300">ยืนยัน</button>

                                <button id="btn-next-round" class="hidden z-[100] mt-2 bg-[#EE609A] hover:bg-[#d62c65] rounded-full py-1 px-1.5 w-[60px] border border-white text-white text-center text-sm whitespace-nowrap duration-300">เริ่ม</button>
                            @endif

                        </div>
                    </div>
                    <!-- END TIMER -->

                    @if(count($room_nightmares) == 5)
                        <!-- START NIGHTMARE CARD 1 -->
                        <div class="z-[100] absolute bottom-0 left-1/5 transform translate-y-14 cursor-pointer rounded-full">
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[0]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        @if($room_nightmares[0]->link_id == 21)
                            <div class="div-link z-50 absolute bottom-0 right-0 transform -translate-x-5 translate-y-2 rotate-[140deg] rounded-full"
                            data-link_status="{{ $room_nightmares[0]->link_status }}">
                                <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                    <div class="z-20 w-[90px] h-full overflow-hidden">
                                        <img src="{{ URL('/uploads/' . $room_nightmares[0]->link_image) }}" class="link_image w-full h-auto object-cover" alt="">
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="btn-link div-link z-50 absolute bottom-0 right-0 transform -translate-x-5 translate-y-2 rotate-[140deg] cursor-pointer rounded-full"
                            onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[0]->room_link_id }}" data-link_status="{{ $room_nightmares[0]->link_status }}"
                            data-nightmare_id_1="{{ $room_nightmares[0]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[0]->nm_image) }}" 
                            data-nightmare_id_2="{{ $room_nightmares[1]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[1]->nm_image) }}">
                                <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                    <div class="z-20 w-[90px] h-full overflow-hidden">
                                        <img src="{{ URL('/uploads/' . $room_nightmares[0]->link_image) }}" class="link_image w-full h-auto object-cover" alt="">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- END NIGHTMARE CARD 1 -->
                        
                        <!-- START NIGHTMARE CARD 2 -->
                        <div class="z-[100] absolute bottom-0 right-1 transform translate-x-8 -translate-y-14 -rotate-[75deg] cursor-pointer rounded-full">
                            <div class="nightmare-select hidden z-[101] w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full"
                            data-room_nightmare_id="{{ $room_nightmares[1]->room_nightmare_id }}">
                                <div class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white border-[3px] border-[#7068ec] bg-white rounded-full p-1">
                                    <div class="circle hidden w-5 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8586f4] rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[86px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[1]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-link div-link z-50 absolute top-1/5 right-0 transform translate-x-7 -translate-y-12 rotate-[70deg] cursor-pointer rounded-full"
                        onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[1]->room_link_id }}" data-link_status="{{ $room_nightmares[1]->link_status }}"
                        data-nightmare_id_1="{{ $room_nightmares[1]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[1]->nm_image) }}" 
                        data-nightmare_id_2="{{ $room_nightmares[2]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[2]->nm_image) }}">
                            <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-[40px] overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[1]->link_image) }}" class="link_image mt-[-28px] w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- END NIGHTMARE CARD 2 -->

                        <!-- START NIGHTMARE CARD 3 -->
                        <div class="z-[100] absolute top-0 right-0 transform -translate-x-5 -translate-y-7 -rotate-[140deg] cursor-pointer rounded-full">
                            <div class="nightmare-select hidden z-[101] w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full"
                            data-room_nightmare_id="{{ $room_nightmares[2]->room_nightmare_id }}">
                                <div class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white border-[3px] border-[#7068ec] bg-white rounded-full p-1">
                                    <div class="circle hidden w-5 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8586f4] rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[85px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[2]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-link div-link z-50 absolute top-0 left-1/5 transform translate-x-1 -translate-y-4 rotate-[0deg] cursor-pointer rounded-full"
                        onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[2]->room_link_id }}" data-link_status="{{ $room_nightmares[2]->link_status }}"
                        data-nightmare_id_1="{{ $room_nightmares[2]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[2]->nm_image) }}" 
                        data-nightmare_id_2="{{ $room_nightmares[3]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[3]->nm_image) }}">
                            <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-[40px] overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[2]->link_image) }}" class="link_image mt-[-28px] w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- END NIGHTMARE CARD 3 -->

                        <!-- START NIGHTMARE CARD 4 -->
                        <div class="z-[100] absolute top-0 left-0 transform translate-x-7 -translate-y-7 rotate-[140deg] cursor-pointer">
                            <div class="nightmare-select hidden z-[101] w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full"
                            data-room_nightmare_id="{{ $room_nightmares[3]->room_nightmare_id }}">
                                <div class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white border-[3px] border-[#7068ec] bg-white rounded-full p-1">
                                    <div class="circle hidden w-5 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8586f4] rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[85px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[3]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-link div-link z-50 absolute bottom-1/5 left-0 transform -translate-x-5 -translate-y-12 -rotate-[70deg] cursor-pointer rounded-full"
                        onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[3]->room_link_id }}" data-link_status="{{ $room_nightmares[3]->link_status }}"
                        data-nightmare_id_1="{{ $room_nightmares[3]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[3]->nm_image) }}" 
                        data-nightmare_id_2="{{ $room_nightmares[4]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[4]->nm_image) }}">
                            <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-[40px] overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[3]->link_image) }}" class="link_image mt-[-28px] w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- END NIGHTMARE CARD 4 -->

                        <!-- START NIGHTMARE CARD 5 -->
                        <div class="z-[100] absolute bottom-0 left-0 transform -translate-x-7 -translate-y-14 rotate-[75deg] cursor-pointer">
                            <div class="nightmare-select hidden z-[101] w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full"
                            data-room_nightmare_id="{{ $room_nightmares[4]->room_nightmare_id }}">
                                <div class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white border-[3px] border-[#7068ec] bg-white rounded-full p-1">
                                    <div class="circle hidden w-5 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8586f4] rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[85px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[4]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        @if($room_nightmares[4]->link_id == 21)
                            <div class="div-link z-50 absolute bottom-0 left-0 transform translate-x-5 translate-y-2 -rotate-[140deg] rounded-full"
                            data-link_status="{{ $room_nightmares[4]->link_status }}">
                                <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                    <div class="z-20 w-[90px] h-full overflow-hidden">
                                        <img src="{{ URL('/uploads/' . $room_nightmares[4]->link_image) }}" class="link_image w-full h-auto object-cover" alt="">
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="btn-link div-link z-50 absolute bottom-0 left-0 transform translate-x-5 translate-y-2 -rotate-[140deg] cursor-pointer rounded-full"
                            onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[4]->room_link_id }}" data-link_status="{{ $room_nightmares[4]->link_status }}"
                            data-nightmare_id_1="{{ $room_nightmares[4]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[4]->nm_image) }}" 
                            data-nightmare_id_2="{{ $room_nightmares[0]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[0]->nm_image) }}">
                                <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                    <div class="z-20 w-[90px] h-full overflow-hidden">
                                        <img src="{{ URL('/uploads/' . $room_nightmares[4]->link_image) }}" class="link_image w-full h-auto object-cover" alt="">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- END NIGHTMARE CARD 5 -->
                    @else
                        <!-- START NIGHTMARE CARD 1 -->
                        <div class="z-[100] absolute bottom-0 left-1/5 transform translate-y-14 cursor-pointer rounded-full">
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[80px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[0]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-link div-link z-50 absolute bottom-0 right-0 transform -translate-x-6 translate-y-6 rotate-[150deg] cursor-pointer rounded-full"
                        onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[0]->room_link_id }}" data-link_status="{{ $room_nightmares[0]->link_status }}" 
                        data-nightmare_id_1="{{ $room_nightmares[0]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[1]->nm_image) }}" 
                        data-nightmare_id_2="{{ $room_nightmares[1]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[2]->nm_image) }}">
                            <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[0]->link_image) }}" class="link_image w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- END NIGHTMARE CARD 1 -->
                        
                        <!-- START NIGHTMARE CARD 2 -->
                        <div class="z-[100] absolute bottom-0 right-1 transform translate-x-8 -translate-y-8 -rotate-[70deg] cursor-pointer rounded-full">
                            <div class="nightmare-select hidden z-[101] w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full"
                            data-room_nightmare_id="{{ $room_nightmares[1]->room_nightmare_id }}">
                                <div class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white border-[3px] border-[#7068ec] bg-white rounded-full p-1">
                                    <div class="circle hidden w-5 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8586f4] rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[80px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[1]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-link div-link z-50 absolute top-1/5 right-0 transform translate-x-12 -translate-y-3 rotate-[90deg] cursor-pointer rounded-full"
                        onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[1]->room_link_id }}" data-link_status="{{ $room_nightmares[1]->link_status }}"
                        data-nightmare_id_1="{{ $room_nightmares[1]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[1]->nm_image) }}" 
                        data-nightmare_id_2="{{ $room_nightmares[2]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[2]->nm_image) }}">
                            <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-[40px] overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[1]->link_image) }}" class="link_image mt-[-28px] w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- END NIGHTMARE CARD 2 -->

                        <!-- START NIGHTMARE CARD 3 -->
                        <div class="z-[100] absolute top-0 right-0 transform translate-x-8 translate-y-0 -rotate-[120deg] cursor-pointer rounded-full">
                            <div class="nightmare-select hidden z-[101] w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full"
                            data-room_nightmare_id="{{ $room_nightmares[2]->room_nightmare_id }}">
                                <div class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white border-[3px] border-[#7068ec] bg-white rounded-full p-1">
                                    <div class="circle hidden w-5 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8586f4] rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[80px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[2]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-link div-link z-50 absolute top-0 left-1/5 transform translate-x-20 -translate-y-6 rotate-[30deg] cursor-pointer rounded-full"
                        onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[2]->room_link_id }}" data-link_status="{{ $room_nightmares[2]->link_status }}"
                        data-nightmare_id_1="{{ $room_nightmares[2]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[2]->nm_image) }}" 
                        data-nightmare_id_2="{{ $room_nightmares[3]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[3]->nm_image) }}">
                            <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-[40px] overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[2]->link_image) }}" class="link_image mt-[-28px] w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- END NIGHTMARE CARD 3 -->

                        <!-- START NIGHTMARE CARD 4 -->
                        <div class="z-[100] absolute top-0 left-1/5 transform translate-x-0 -translate-y-20 rotate-[180deg] cursor-pointer">
                            <div class="nightmare-select hidden z-[101] w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full"
                            data-room_nightmare_id="{{ $room_nightmares[3]->room_nightmare_id }}">
                                <div class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white border-[3px] border-[#7068ec] bg-white rounded-full p-1">
                                    <div class="circle hidden w-5 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8586f4] rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[80px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[3]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-link div-link z-50 absolute top-0 left-0 transform translate-x-6 -translate-y-5 -rotate-[30deg] cursor-pointer rounded-full"
                        onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[3]->room_link_id }}" data-link_status="{{ $room_nightmares[3]->link_status }}"
                        data-nightmare_id_1="{{ $room_nightmares[3]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[3]->nm_image) }}" 
                        data-nightmare_id_2="{{ $room_nightmares[4]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[4]->nm_image) }}">
                            <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-[40px] overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[3]->link_image) }}" class="link_image mt-[-28px] w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- END NIGHTMARE CARD 4 -->

                        <!-- START NIGHTMARE CARD 5 -->
                        <div class="z-[100] absolute top-0 left-0 transform -translate-x-8 translate-y-1 rotate-[120deg] cursor-pointer">
                            <div class="nightmare-select hidden z-[101] w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full"
                            data-room_nightmare_id="{{ $room_nightmares[4]->room_nightmare_id }}">
                                <div class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white border-[3px] border-[#7068ec] bg-white rounded-full p-1">
                                    <div class="circle hidden w-5 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8586f4] rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[80px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[4]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-link div-link z-50 absolute top-1/2 left-0 transform -translate-x-14 -translate-y-14 -rotate-[90deg] cursor-pointer rounded-full"
                        onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[4]->room_link_id }}" data-link_status="{{ $room_nightmares[4]->link_status }}"
                        data-nightmare_id_1="{{ $room_nightmares[4]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[4]->nm_image) }}" 
                        data-nightmare_id_2="{{ $room_nightmares[5]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[5]->nm_image) }}">
                            <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[4]->link_image) }}" class="link_image w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- END NIGHTMARE CARD 5 -->

                        <!-- START NIGHTMARE CARD 6 -->
                        <div class="z-[100] absolute bottom-0 left-0 transform -translate-x-7 -translate-y-9 rotate-[70deg] cursor-pointer">
                            <div class="nightmare-select hidden z-[101] w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full"
                            data-room_nightmare_id="{{ $room_nightmares[5]->room_nightmare_id }}">
                                <div class="w-8 h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white border-[3px] border-[#7068ec] bg-white rounded-full p-1">
                                    <div class="circle hidden w-5 h-5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8586f4] rounded-full"></div>
                                </div>
                            </div>
                            <div class="relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[80px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[5]->nm_image) }}" class="nm_image btn-image-zoom w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-link div-link z-50 absolute bottom-0 left-0 transform translate-x-6 translate-y-6 -rotate-[150deg] cursor-pointer rounded-full"
                        onclick="FetchCards(this)" data-room_link_id="{{ $room_nightmares[5]->room_link_id }}" data-link_status="{{ $room_nightmares[5]->link_status }}"
                        data-nightmare_id_1="{{ $room_nightmares[5]->nightmare_id }}" data-image_1="{{ URL('/uploads/' . $room_nightmares[5]->nm_image) }}" 
                        data-nightmare_id_2="{{ $room_nightmares[0]->nightmare_id }}" data-image_2="{{ URL('/uploads/' . $room_nightmares[0]->nm_image) }}">
                            <div class="z-50 relative flex-col flex items-center justify-center w-full rounded overflow-hidden">
                                <div class="z-20 w-[90px] h-full overflow-hidden">
                                    <img src="{{ URL('/uploads/' . $room_nightmares[5]->link_image) }}" class="link_image w-full h-auto object-cover" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- END NIGHTMARE CARD 5 -->
                    @endif

                </div>
                <!-- END NIGHTMARE CARD -->

            </div>
        </div>
        <!-- END CIRCLE -->


        <!-- START BOTTOM BUTTON -->
        <div class="z-[100] absolute bottom-3 left-2">
            <button onclick="FetchResults()" id="btn-result" class="bg-[#EE609A] hover:bg-[#d62c65] rounded-full py-1.5 px-2 w-[75px] border border-white text-sm text-white text-center whitespace-nowrap duration-300">ผลลัพธ์</button>
            <button id="btn-actions" class="bg-[#EE609A] hover:bg-[#d62c65] rounded-full py-1.5 px-2 w-[75px] border border-white text-sm text-white text-center whitespace-nowrap duration-300">การกระทำ</button>
            <button id="btn-tips" class="bg-[#EE609A] hover:bg-[#d62c65] rounded-full py-1.5 px-2 w-[75px] border border-white text-sm text-white text-center whitespace-nowrap duration-300">เป้าหมาย</button>
        </div>

        <div class="z-[100] absolute bottom-3 right-2">
            <button id="btn-leave-room" class="bg-indigo-800 hover:bg-indigo-900 rounded-full py-1.5 px-2 w-fit border border-white text-sm text-white text-center whitespace-nowrap duration-300">ออกจากห้อง</button>
        </div>
        <!-- END BOTTOM BUTTON -->

    </div>
    <!-- END CONTENT -->



    <!-- START MODAL TIPS -->
    <div id="modal-tips" class="modal hidden fixed z-[100] flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:px-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content w-[350px] bg-[#e6e4f0] m-auto rounded-2xl drop-shadow-xl">
        <span id="icon-tips-close" class="z-20 text-black bg-white rounded-full drop-shadow border text-[24px] font-bold h-fit font-medium absolute top-0 right-0 mt-2 mr-2 hover:text-indigo-600 hover:bg-indigo-200 duration-300 cursor-pointer"><i class='bx bx-x'></i></span>
            <div class="relative p-4 flex-col flex items-center justify-center">

                <span id="btn-prev-goal" onclick="showPrevGoal()" class="z-10 absolute top-1/2 transform -translate-y-1/2 left-2 h-fit text-[30px] text-indigo-600 hover:bg-white rounded-full duration-300 cursor-pointer">
                    <i class='bx bx-chevrons-left'></i>
                </span>
                <span id="btn-next-goal" onclick="showNextGoal()" class="z-10 absolute top-1/2 transform -translate-y-1/2 right-2 h-fit text-[30px] text-indigo-600 hover:bg-white rounded-full duration-300 cursor-pointer">
                    <i class='bx bx-chevrons-right'></i>
                </span>

                <div id="goal-1" class="w-full">
                    <!-- START HEADER -->
                    <div class="text-gray-900 text-xl font-medium w-full text-center">
                        <h1>เป้าหมาย (Goal)</h1>
                    </div>
                    <hr class="my-4 w-full h-px bg-gray-400 border-0">
                    <!-- END HEADER -->

                    <!-- START IMAGE -->
                    <div class="flex justify-between w-full">
                        <div class="relative w-[150px] overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/tips-01-01.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                        </div>
                        <div class="relative w-[150px] overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/tips-01-02.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                    <hr class="my-4 w-full h-px bg-gray-400 border-0">
    
                    <!-- START TEXT -->
                    <div class="w-full text-center font-light text-gray-700">
                        <p>โดยทำให้ฝันร้ายล้อมรอบแผ่น</p>
                        <p>โดยทำให้ฝันร้ายล้อมรอบแผ่น</p>
                        <p>มั่นคงฝันร้ายจะถูกเปลี่ยนเป็นสงบ</p>
                    </div>
                    <!-- END TEXT -->
                </div>

                <div id="goal-2" class="hidden w-full">
                    <!-- START HEADER -->
                    <div class="text-gray-900 text-xl font-medium w-full text-center">
                        <h1>เป้าหมาย (Goal)</h1>
                    </div>
                    <hr class="my-4 w-full h-px bg-gray-400 border-0">
                    <!-- END HEADER -->

                    <!-- START IMAGE -->
                    <div class="flex justify-center w-full">
                        <div class="relative w-[150px] overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/element-76.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                    <hr class="my-4 w-full h-px bg-gray-400 border-0">
    
                    <!-- START TEXT -->
                    <div class="w-full text-center font-light text-gray-700">
                        <p>ในเเต่ละสถานที่สร้างวงจรความฝันได้เพียง</p>
                        <p>2 วงเท่านั้น ถ้ามีสถานที่ใดสร้างวงจรความฝัน</p>
                        <p>มากกว่า 2 วง วงที่เกินมาจะไม่ถูกนับว่าปิดไม่สำเร็จ</p>
                    </div>
                    <!-- END TEXT -->
                </div>

                <div id="goal-3" class="hidden w-full">
                    <!-- START HEADER -->
                    <div class="text-gray-900 text-xl font-medium w-full text-center">
                        <h1>กฎที่จำเป็น (Rules)</h1>
                    </div>
                    <hr class="my-4 w-full h-px bg-gray-400 border-0">
                    <!-- END HEADER -->
    
                    <!-- START TEXT -->
                    <div class="w-full flex justify-center font-light text-gray-700">
                        <div class="w-fit text-left text-sm">
                            <p>1. นักเดินทางฝันต้องอยู่ตำแหน่งฝันที่จะทำภารกิจเสมอ</p>
                            <p>2. การ์ดที่ถูกย้ายจะต้องถูกคว่ำเสมอ</p>
                            <p>3. การสร้างแผ่นมั่งคงจะต้องสร้างภายในเวลาที่กำหนด</p>
                            <p>&nbsp;โดยใช้การ์ดทักษะ 2 ใบ ที่มีทักษะเหมาะกับฝันร้ายทั้ง 2 ฝัน</p>
                            <p>&nbsp;จากตำแหน่งฝันร้ายเเรกเเละอีก 2 ใบ จากฝันร้ายข้างเคียง</p>
                        </div>
                    </div>
                    <!-- END TEXT -->
                </div>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL TIPS -->

    <!-- START MODAL ACTIONS -->
    <div id="modal-actions" class="modal hidden fixed z-[100] flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:px-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content w-[350px] bg-[#e6e4f0] m-auto rounded-2xl drop-shadow-xl">
        <span id="icon-actions-close" class="z-20 text-black bg-white rounded-full drop-shadow border text-[24px] font-bold h-fit font-medium absolute top-0 right-0 mt-2 mr-2 hover:text-indigo-600 hover:bg-indigo-200 duration-300 cursor-pointer"><i class='bx bx-x'></i></span>
            <div class="relative p-4 flex-col flex items-center justify-center">

                <!-- START HEADER -->
                <div class="text-gray-900 text-xl font-medium w-full text-center">
                    <h1>การกระทำ (Action)</h1>
                </div>
                <hr class="mt-4 w-full h-px bg-gray-400 border-0">
                <!-- END HEADER -->

                <!-- START ACTION IMAGES -->
                <div id="actions-all" class="w-full">
                    <!-- START IMAGE -->
                    <div class="grid grid-cols-3 w-full gap-2">
                        <div id="action-1" onclick="showActionDetails(1)" class="animate-pulse relative w-[100px] overflow-hidden hover:bg-indigo-300 rounded-2xl cursor-pointer duration-300">
                            <img src="{{ URL('/assets/web_based_board_game/element add-70.png') }}" class="w-full h-full object-cover m-auto" alt="action">
                        </div>
                        <div id="action-2" onclick="showActionDetails('2-1')" class="animate-pulse relative w-[100px] overflow-hidden hover:bg-indigo-300 rounded-2xl cursor-pointer duration-300">
                            <img src="{{ URL('/assets/web_based_board_game/element add-71.png') }}" class="w-full h-full object-cover m-auto" alt="action">
                        </div>
                        <div id="action-3" onclick="showActionDetails('3-1')" class="animate-pulse relative w-[100px] overflow-hidden hover:bg-indigo-300 rounded-2xl cursor-pointer duration-300">
                            <img src="{{ URL('/assets/web_based_board_game/element add-72.png') }}" class="w-full h-full object-cover m-auto" alt="action">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 w-full">
                        <div id="action-4" onclick="showActionDetails(4)" class="animate-pulse relative w-[100px] overflow-hidden hover:bg-indigo-300 m-auto rounded-2xl cursor-pointer duration-300">
                            <img src="{{ URL('/assets/web_based_board_game/element add-74.png') }}" class="w-full h-full object-cover m-auto" alt="action">
                        </div>
                        <div id="action-5" onclick="showActionDetails(5)" class="animate-pulse relative w-[100px] overflow-hidden hover:bg-indigo-300 m-auto rounded-2xl cursor-pointer duration-300">
                            <img src="{{ URL('/assets/web_based_board_game/element add-73.png') }}" class="w-full h-full object-cover m-auto" alt="action">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                </div>
                <!-- END ACTION IMAGES -->

                <div id="icon-actions-back" onclick="showActionsAll()" class="z-20 hidden text-black bg-white rounded-full drop-shadow border text-[24px] font-bold h-fit font-medium absolute top-0 left-0 mt-2 ml-2 hover:text-indigo-600 hover:bg-indigo-200 duration-300 cursor-pointer"><i class='bx bx-left-arrow-alt'></i></div>

                <!-- START ACTION DETAILS -->
                <div id="action-details-1" class="hidden w-full">
                    <!-- START IMAGE -->
                    <div class="flex justify-center w-full">
                        <div class="relative w-[125px] overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/element add-70.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                    <hr class="mb-4 w-full h-px bg-gray-400 border-0">
    
                    <!-- START TEXT -->
                    <div class="w-full text-center font-light text-gray-700">
                        <h1 class="text-[#322E53] font-medium ">การเดินผ่านตัวเชื่อมโยง</h1>
                        <p>ผู้เล่นต้องใช้หน้าเต๋า 2 ลูก</p>
                        <p>เพื่อเดินไปยังตำแหน่งที่อยู่ถัดไป</p>
                        <br>
                        <h1 class="text-[#322E53] font-medium ">การเดินผ่านตัวมั่นคง</h1>
                        <p>ผู้เล่นสามารถใช้หน้าเต๋าเพียง 1 ลูก</p>
                        <p>ถ้าแผ่นเชือมโยงถูกเปลี่ยนเป็นแผ่นมั่นคงแล้ว</p>
                    </div>
                    <!-- END TEXT -->
                </div>

                <div id="action-details-2-1" class="hidden w-full">
                    <!-- START IMAGE -->
                    <div class="flex-col flex justify-center w-full">
                        <div class="relative w-[125px] m-auto overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/element add-71.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="action">
                        </div>
                        
                        <h1 class="mb-4 text-center text-[#322E53] font-medium ">ตำเเหน่ง ฝันหลัก/ฝันสงบ</h1>

                        <div class="relative w-[100px] h-[100px] m-auto overflow-hidden shadow">
                            <img src="{{ URL('/assets/web_based_board_game/action-02.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-md px-[1px]" alt="action">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                    <hr class="my-4 w-full h-px bg-gray-400 border-0">
    
                    <!-- START TEXT -->
                    <div class="w-full text-center font-light text-gray-700">
                        <p>ผู้เล่นต้องใช้หน้าเต๋า 2 ลูก</p>
                        <p>เพื่อทิ้งการ์ดทักษะลงกองจั่ว โดยใส่ไว้ใต้กองจั่ว</p>
                        <p>เเละจั่วการ์ดทักษะใบใหม่วางหงาย</p>
                        <p>ที่ตำเเหน่งฝันที่นักเดินทางฝันอยู่</p>
                    </div>
                    <!-- END TEXT -->
                    <div onclick="showActionDetails('2-1')" class="btn-prev-2.1 z-20 hidden text-black text-[28px] font-bold h-fit font-medium absolute bottom-0 left-0 mb-2 ml-2 hover:text-indigo-600 duration-300 cursor-pointer"><i class='bx bx-left-arrow-alt'></i></div>
                    <div onclick="showActionDetails('2-2')" class="btn-next-2.2 z-20 text-black text-[28px] font-bold h-fit font-medium absolute bottom-0 right-0 mb-2 mr-2 hover:text-indigo-600 duration-300 cursor-pointer"><i class='bx bx-right-arrow-alt'></i></div>
                </div>

                <div id="action-details-2-2" class="hidden w-full">
                    <!-- START IMAGE -->
                    <div class="flex-col flex justify-center w-full">
                        <div class="relative w-[125px] m-auto overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/element add-71.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="action">
                        </div>
                        
                        <h1 class="mb-4 text-center text-[#322E53] font-medium ">ตำเเหน่ง ฝันร้าย</h1>

                        <div class="relative w-[100px] h-[100px] m-auto overflow-hidden shadow">
                            <img src="{{ URL('/assets/web_based_board_game/action-03.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-md px-[1px]" alt="action">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                    <hr class="my-4 w-full h-px bg-gray-400 border-0">
    
                    <!-- START TEXT -->
                    <div class="w-full text-center font-light text-gray-700">
                        <p>ผู้เล่นต้องใช้หน้าเต๋า 2 ลูก</p>
                        <p>เพื่อล็อกการ์ดทักษะหรือใช้ปลดล็อกการ์ดทักษะ</p>
                        <p>ที่ถูกวางไว้อยู่เเล้วการ์ดที่ล็อกเเล้วไม่สามารถ</p>
                        <p>ย้ายตำเเหน่งได้อีกจนกว่าจะถูกปลดล็อก</p>
                    </div>
                    <!-- END TEXT -->
                    <div onclick="showActionDetails('2-1')" class="btn-prev-2.1 z-20 hidden text-black text-[28px] font-bold h-fit font-medium absolute bottom-0 left-0 mb-2 ml-2 hover:text-indigo-600 duration-300 cursor-pointer"><i class='bx bx-left-arrow-alt'></i></div>
                    <div onclick="showActionDetails('2-2')" class="btn-next-2.2 z-20 text-black text-[28px] font-bold h-fit font-medium absolute bottom-0 right-0 mb-2 mr-2 hover:text-indigo-600 duration-300 cursor-pointer"><i class='bx bx-right-arrow-alt'></i></div>
                </div>  
                
                <div id="action-details-3-1" class="hidden w-full">
                    <!-- START IMAGE -->
                    <div class="flex-col flex justify-center w-full">
                        <div class="relative w-[125px] m-auto overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/element add-72.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                        </div>

                        <h1 class="mb-4 text-center text-[#322E53] font-medium ">ตำเเหน่ง ฝันหลัก/ฝันสงบ</h1>

                        <div class="relative w-[100px] h-[100px] m-auto m-auto overflow-hidden shadow">
                            <img src="{{ URL('/assets/web_based_board_game/action-02.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-md px-[1px]" alt="action">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                    <hr class="my-4 w-full h-px bg-gray-400 border-0">
    
                    <!-- START TEXT -->
                    <div class="w-full text-center font-light text-gray-700">
                        <p>ผู้เล่นต้องใช้หน้าเต๋า 2 ลูก</p>
                        <p>เพื่อจั๋วการ์ดทักษะใหม่จากกองไพ่</p>
                        <p>วงการ์ดใต้ต่อฝันหลัก/ฝันสงบ</p>
                    </div>
                    <!-- END TEXT -->

                    <div onclick="showActionDetails('3-1')" class="btn-prev-3.1 z-20 hidden text-black text-[28px] font-bold h-fit font-medium absolute bottom-0 left-0 mb-2 ml-2 hover:text-indigo-600 duration-300 cursor-pointer"><i class='bx bx-left-arrow-alt'></i></div>
                    <div onclick="showActionDetails('3-2')" class="btn-next-3.2 z-20 text-black text-[28px] font-bold h-fit font-medium absolute bottom-0 right-0 mb-2 mr-2 hover:text-indigo-600 duration-300 cursor-pointer"><i class='bx bx-right-arrow-alt'></i></div>
                </div>
                <div id="action-details-3-2" class="hidden w-full">
                    <!-- START IMAGE -->
                    <div class="flex-col flex justify-center w-full">
                        <div class="relative w-[125px] m-auto overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/element add-72.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                        </div>

                        <h1 class="mb-4 text-center text-[#322E53] font-medium ">ตำเเหน่ง ฝันร้าย</h1>

                        <div class="relative w-[100px] h-[100px] m-auto m-auto overflow-hidden shadow">
                            <img src="{{ URL('/assets/web_based_board_game/action-04.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-md px-[1px]" alt="action">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                    <hr class="my-4 w-full h-px bg-gray-400 border-0">
    
                    <!-- START TEXT -->
                    <div class="w-full text-center font-light text-gray-700">
                        <p>ผู้เล่นต้องใช้หน้าเต๋า 2 ลูก</p>
                        <p>ในการเปลี่ยนตัวเชื่อมโยงเป็นตัวมั่นคง</p>
                        <p>โดยใช้การ์ด 4 ใบ จากฝันร้าย 2 ตำแหน่ง</p>
                        <p>ตามเงื่อนไข ใส่ข้อมูลการ์ดลงลนแผ่นเชื่อมโยง</p>
                        <p>เพื่อเเลกตัวมั่นคงตามที่กำหนดก่อนหมดเวลา</p>
                    </div>
                    <!-- END TEXT -->

                    <div onclick="showActionDetails('3-1')" class="btn-prev-3.1 z-20 hidden text-black text-[28px] font-bold h-fit font-medium absolute bottom-0 left-0 mb-2 ml-2 hover:text-indigo-600 duration-300 cursor-pointer"><i class='bx bx-left-arrow-alt'></i></div>
                    <div onclick="showActionDetails('3-2')" class="btn-next-3.2 z-20 text-black text-[28px] font-bold h-fit font-medium absolute bottom-0 right-0 mb-2 mr-2 hover:text-indigo-600 duration-300 cursor-pointer"><i class='bx bx-right-arrow-alt'></i></div>
                </div>

                <div id="action-details-4" class="hidden w-full">
                    <!-- START IMAGE -->
                    <div class="flex justify-center w-full">
                        <div class="relative w-[125px] overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/element add-74.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                    <hr class="mb-4 w-full h-px bg-gray-400 border-0">
    
                    <!-- START TEXT -->
                    <div class="w-full text-center font-light text-gray-700">
                        <p>ใช้หน้าเต๋าที่เหมือนกัน 2 ลูก</p>
                        <p>เพื่อย้ายการ์ดทักษะไปทางฝันร้าย<span class="text-rose-600">ด้านขวา</span></p>
                        <p>การ์ดทักษะการ์ดจะที่ถูกย้ายเมื่อจะต้อง</p>
                        <p>คว่ำหน้าเสมอ การ์ดจะหงายหน้าเมื่อถูกล็อกหรือถูก</p>
                        <p>ใช้เพื่อสร้างเเผ่นมั่นคง หรือจนกว่าจะจบรอบ</p>
                    </div>
                    <!-- END TEXT -->
                </div>

                <div id="action-details-5" class="hidden w-full">
                    <!-- START IMAGE -->
                    <div class="flex justify-center w-full">
                        <div class="relative w-[125px] overflow-hidden">
                            <img src="{{ URL('/assets/web_based_board_game/element add-73.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                        </div>
                    </div>
                    <!-- END IMAGE -->
                    <hr class="mb-4 w-full h-px bg-gray-400 border-0">
    
                    <!-- START TEXT -->
                    <div class="w-full text-center font-light text-gray-700">
                        <p>ใช้หน้าเต๋าที่เหมือนกัน 2 ลูก</p>
                        <p>เพื่อย้ายการ์ดทักษะไปทางฝันร้าย<span class="text-rose-600">ด้านซ้าย</span></p>
                        <p>การ์ดทักษะการ์ดจะที่ถูกย้ายเมื่อจะต้อง</p>
                        <p>คว่ำหน้าเสมอ การ์ดจะหงายหน้าเมื่อถูกล็อกหรือถูก</p>
                        <p>ใช้เพื่อสร้างเเผ่นมั่นคง หรือจนกว่าจะจบรอบ</p>
                    </div>
                    <!-- END TEXT -->
                </div>
                <!-- END ACTION DETAILS -->

            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL ACTIONS -->

    <!-- START MODAL NIGHTMARE -->
    <div id="modal-nightmare" class="modal hidden fixed z-[100] flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:px-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content w-[350px] bg-[#e6e4f0] m-auto rounded-2xl drop-shadow-xl">
            <span id="icon-nightmare-close" class="z-20 text-black bg-white rounded-full drop-shadow border text-[24px] font-bold h-fit font-medium absolute top-0 right-0 mt-2 mr-2 hover:text-indigo-600 hover:bg-indigo-200 duration-300 cursor-pointer"><i class='bx bx-x'></i></span>
            <div class="relative p-4 flex-col flex items-center justify-center">
                
                <div class="text-gray-900 text-xl font-medium w-full text-center">
                    <h1>รายละเอียดฝันร้าย</h1>
                </div>
                <hr class="my-4 w-full h-px bg-gray-400 border-0">

                <!-- START IMAGE -->
                <div class="flex justify-between w-full">
                    <div class="relative w-[100px] overflow-hidden">
                        <img id="modal_nightmare_1" src="{{ URL('/assets/nightmare_crop/NM for print-01.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                    </div>
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 translate-y-28 w-[110px] h-[48px] overflow-hidden m-auto rotate-180">
                        <img id="modal_link" src="{{ URL('/assets/web_based_board_game/element add-69.png') }}" class="btn-image-zoom w-full h-full object-cover cursor-pointer rounded-full" alt="link-card">
                    </div>
                    <div class="relative w-[100px] overflow-hidden">
                        <img id="modal_nightmare_2" src="{{ URL('/assets/nightmare_crop/NM for print-02.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto cursor-pointer rounded-full px-[1px]" alt="nightmare-card">
                    </div>
                </div>
                <!-- END IMAGE -->

                <hr class="my-4 w-full h-px bg-gray-400 border-0">
                

                <!-- START INPUT CARDS -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <!-- START INPUT -->
                        <div class="relative">
                            <input type="text" id="card_code_1" placeholder="รหัสการ์ด" class="placeholder-white w-full text-sm font-light bg-[#A39FC6] border-2 border-white rounded-full px-3 py-1.5 focus:outline-none">
                            <button onclick="CardAdd(this)" data-button_input="nm_left" class="absolute top-[5px] right-1.5 w-fit text-white p-1 rounded-full bg-[#EE609A] border border-white hover:bg-[#d62c65] duration-300 focus:ring-4 focus:outline-none focus:ring-indigo-200"><i class='bx bx-plus'></i></button>
                            <style>
                                .placeholder-white::placeholder {
                                    color: white;
                                }
                            </style>
                        </div>
                        <!-- END INPUT -->
        
                        <!-- START IMAGE -->
                        <div class="mt-1 grid grid-cols-1 gap-3">
                            <div class="relative cursor-pointer">
                                <div class="relative h-[120px] overflow-hidden border border-[#EE609A]">
                                    <img id="modal_card_1" src="{{ URL('/assets/skill card crop/element-empty.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto" alt="nightmare-card">
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <div class="relative h-[120px] overflow-hidden border border-[#EE609A]">
                                    <img id="modal_card_2" src="{{ URL('/assets/skill card crop/element-empty.png') }}" class="btn-image-zoom w-full h-full my-auto" alt="nightmare-card">
                                </div>
                            </div>
                        </div>
                        <!-- END IMAGE -->
                    </div>

                    <div>
                        <!-- START INPUT -->
                        <div class="relative">
                            <input type="text" id="card_code_2" placeholder="รหัสการ์ด" class="placeholder-white w-full text-sm font-light bg-[#A39FC6] border-2 border-white rounded-full px-3 py-1.5 focus:outline-none">
                            <button onclick="CardAdd(this)" data-button_input="nm_right" class="absolute top-[5px] right-1.5 w-fit text-white p-1 rounded-full bg-[#EE609A] border border-white hover:bg-[#d62c65] duration-300 focus:ring-4 focus:outline-none focus:ring-indigo-200"><i class='bx bx-plus'></i></button>
                            <style>
                                .placeholder-white::placeholder {
                                    color: white;
                                }
                            </style>
                        </div>
                        <!-- END INPUT -->
        
                        <!-- START IMAGE -->
                        <div class="mt-1 grid grid-cols-1 gap-3">
                            <div class="relative cursor-pointer">
                                <div class="relative h-[120px] overflow-hidden border border-[#EE609A]">
                                    <img id="modal_card_3" src="{{ URL('/assets/skill card crop/element-empty.png') }}" class="btn-image-zoom w-full h-full object-cover my-auto" alt="nightmare-card">
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <div class="relative h-[120px] overflow-hidden border border-[#EE609A]">
                                    <img id="modal_card_4" src="{{ URL('/assets/skill card crop/element-empty.png') }}" class="btn-image-zoom w-full h-full my-auto" alt="nightmare-card">
                                </div>
                            </div>
                        </div>
                        <!-- END IMAGE -->
                    </div>
                </div>
                <!-- END INPUT CARDS -->
                
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL NIGHTMARE -->


    <!-- START MODAL TIMEUP -->
    <div id="modal-timeup" class="modal hidden fixed z-[100] flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:px-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content bg-[#E6E4F0] m-auto rounded-2xl drop-shadow-xl">
        <span id="icon-timeup-close" class="z-20 text-black bg-white rounded-full drop-shadow border text-[24px] font-bold h-fit font-medium absolute top-0 right-0 mt-2 mr-2 hover:text-indigo-600 hover:bg-indigo-200 duration-300 cursor-pointer"><i class='bx bx-x'></i></span>
            <div class="relative w-fit min-w-[300px] max-sm:w-[300px] p-3">
                <div class="relative text-[#52459A]">
                    <div class="text-center text-xl">
                        <h1 class="font-bold">TIME UP</h1>
                        <h1 class="font-medium">หมดเวลา!</h1>
                    </div>
                    <div class="mt-4 flex-col flex items-center justify-center space-y-4">
                        <div class="text-center font-light">
                            <p>ผู้เล่นสามารถทำภารกิจสุดท้าย</p>
                            <p>ได้จนลูกเต๋าหมดมือ</p>
                        </div>
                        <div class="w-[250px] h-auto flex justify-center border-2 rounded p-3">
                            <img id="image_timeup" src="{{ URL('/assets/web_based_board_game/element [Recovered].png') }}" alt="" class="w-auto h-auto object-cover animate-shake">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL TIMEUP -->

    <!-- START MODAL RESULT -->
    <div id="modal-result" class="modal hidden fixed z-[100] flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content bg-[#E6E4F0] w-fit min-w-[300px] m-auto rounded-2xl drop-shadow-xl">
            <span id="icon-result-close" class="z-20 text-black bg-white rounded-full drop-shadow border text-[24px] font-bold h-fit font-medium absolute top-0 right-0 mt-2 mr-2 hover:text-indigo-600 hover:bg-indigo-200 duration-300 cursor-pointer"><i class='bx bx-x'></i></span>
            <div class="relative p-4 flex-col flex items-center justify-center">
                <div class="text-center text-xl text-[#52459A]">
                    <h1 class="font-bold">TIME UP</h1>
                    <h1 class="font-medium">หมดเวลา!</h1>
                </div>

                <hr class="my-3 w-full h-px bg-gray-400 border-0">

                <button id="btn-game-end" class="hidden mb-4 bg-[#EE609A] hover:bg-[#d62c65] rounded-full py-1.5 px-2 w-fit border border-white text-white text-center duration-300">ผลลัพธ์เกม</button>

                <div id="alls-items" class="h-[437px] overflow-auto gap-4"></div>

                <div class="noItems hidden w-full text-center">
                    <p class="font-light text-gray-500 text-sm">ไม่พบข้อมูล</p>
                </div>
                
                <!-- START RESULT PROTOTYPE -->
                <div id="linkBoxPt" class="hidden w-full bg-[#A39FC6] rounded-lg p-2 border-2 border-white space-y-3">
                    <div class="relative flex-col flex items-center justify-center w-full">

                        <h1 class="absolute top-1 left-1 text-white text-sm font-light">#<span class="circleText"> n</span></h1>

                        <!-- START LINK -->
                        <div class="relative w-[100px] h-[40px] overflow-hidden cursor-pointer">
                            <img src="{{ URL('/assets/nightmare_crop/element-15.png') }}" class="modal_link_image btn-image-zoom w-full h-full object-cover my-auto" alt="link_image">
                        </div>
                        <!-- END LINK -->

                        <i class='bx bxs-up-arrow text-xl text-white mt-[-5px] mb-2 animate-bounce'></i>

                        <!-- START CARDS PROTOTYPE -->
                        <div class="w-full flex gap-1">
                            <div class="relative cursor-pointer">
                                <div class="relative h-[60px] overflow-hidden border border-[#EE609A]">
                                    <img src="{{ URL('/assets/skill card crop/element-empty.png') }}" class="modal_card_0 btn-image-zoom w-full h-full object-cover my-auto" alt="card-image">
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <div class="relative h-[60px] overflow-hidden border border-[#EE609A]">
                                    <img src="{{ URL('/assets/skill card crop/element-empty.png') }}" class="modal_card_1 btn-image-zoom w-full h-full my-auto" alt="card-image">
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <div class="relative h-[60px] overflow-hidden border border-[#EE609A]">
                                    <img src="{{ URL('/assets/skill card crop/element-empty.png') }}" class="modal_card_2 btn-image-zoom w-full h-full my-auto" alt="card-image">
                                </div>
                            </div>
                            <div class="relative cursor-pointer">
                                <div class="relative h-[60px] overflow-hidden border border-[#EE609A]">
                                    <img src="{{ URL('/assets/skill card crop/element-empty.png') }}" class="modal_card_3 btn-image-zoom w-full h-full my-auto" alt="card-image">
                                </div>
                            </div>
                        </div>
                        <!-- END CARDS PROTOTYPE -->

                    </div>
                </div>
                <!-- END RESULT PROTOTYPE -->
                
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL RESULT -->

    <!-- START MODAL GAME END -->
    <div id="modal-game-end" class="modal hidden fixed z-[100] left-0 top-0 w-[100%] h-[100%] overflow-auto">
        <!-- Modal content -->
        <div class="modal-content fixed inset-0 flex items-center justify-center p-[10px]">
            <div class="relative w-[640px] h-auto min-h-[90vh] object-cover bg-[#e6e4f0] rounded-2xl overflow-hidden">
                <span id="icon-game-end-close" class="z-[100] text-black bg-white rounded-full drop-shadow border text-[24px] font-bold h-fit font-medium absolute top-0 right-0 mt-2 mr-2 hover:text-indigo-600 hover:bg-indigo-200 duration-300 cursor-pointer"><i class='bx bx-x'></i></span>
                <div class="w-full h-full flex justify-center border-2 rounded p-3">
                    <img id="image_game_end" src="{{ URL('/assets/web_based_board_game/ending-03-pc.gif') }}" alt="" class="w-auto h-auto object-cover">
                    <div class="z-10 w-full h-full absolute top-0 left-0 bg-gray-800 opacity-20 bg-set-opacity"></div>
                </div>

                <span id="btn-new-room" class="z-[100] absolute top-1/2 transform -translate-y-1/2 right-0 mr-2 h-fit text-[30px] text-white bg-[#d1ae00] hover:bg-[#a67d02] rounded-full drop-shadow border duration-300 cursor-pointer">
                    <i class='bx bx-right-arrow-alt'></i>
                </span>

                <div id="you-won" class="hidden z-50 absolute top-1/3 left-1/3 transform -translate-x-1/4 -translate-y-1/2 text-center text-white whitespace-nowrap">
                    <h1 class="text-3xl font-medium mb-[1em]">You're won</h1>
                    <p>ผู้ฝันได้ตื่นขึ้นจากหลับใหล</p>
                    <p>พร้อมจะใช้ชีวิตและก้าวต่อไปอย่างเต็มใจ</p>
                </div>
                <div id="you-lost" class="hidden z-50 absolute top-1/3 left-1/3 transform -translate-x-1/4 -translate-y-1/2 text-center text-white whitespace-nowrap">
                    <h1 class="text-3xl font-medium mb-[1em]">You're lost</h1>
                    <p>ผู้ฝันหลงทางอยู่ในโลกแห่งความฝัน</p>
                    <p>เฝ้ารอให้นักเดินทางฝันกลุ่มใหม่</p>
                    <p>มาช่วยเขาให้ตื่นจากหลับใหล</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL IMAGE ZOOM -->

    <!-- START MODAL NEW ROOM -->
    <div id="modal-new-room" class="modal hidden fixed z-[100] flex left-0 top-0 w-[100%] h-[100%] overflow-auto max-md:p-[10px]">
        <!-- START MODAL CONTENT -->
        <div class="modal-content bg-white m-auto rounded-2xl drop-shadow-xl w-fit max-md:max-w-[400px] max-sm:w-full">
            <span id="icon-new-room-close" class="z-[101] text-gray-500 text-[30px] font-medium absolute top-0 right-0 mr-4 hover:text-[#dd8c32] cursor-pointer">&times;</span>
            <div class="relative w-full h-auto rounded-2xl overflow-hidden">
                <!-- START IMAGE -->
                <div class="z-0 absolute top-0 left-0 h-full w-full">
                    <img src="{{ URL('/assets/web_based_board_game/ending-02-pc.png') }}" alt="" class="w-full h-full object-cover my-auto">
                </div>
                <!-- END IMAGE -->

                <div class="grid grid-cols-2 px-3 py-5 max-md:grid-cols-1 max-md:py-3">
                    <div class="z-[100] flex-col flex items-center justify-center">
                        <div class="z-[100] w-[150px] h-fit flex justify-center rounded p-3">
                            <img src="{{ URL('/assets/mini-logo.png') }}" alt="" class="w-auto h-auto object-cover">
                        </div>
                        <div class="z-[100] w-[300px] h-fit flex justify-center rounded p-3 mt-[-100px]">
                            <img src="{{ URL('/assets/web_based_board_game/element-78.png') }}" alt="" class="w-auto h-auto object-cover">
                        </div>
                    </div>
                    
                    <div class="z-[100] w-full h-full flex-col flex items-center justify-center max-md:mt-[-40px] space-y-4">
                        <div class="text-center font-light text-white text-lg">
                            <p>ได้โปรดช่วยผู้หลับไหล</p>
                            <p>ที่หลงทางในโลกแห่งความฝัน</p>
                            <p>ให้ได้ตื่นขึ้นมาใช้ชีวิต</p>
                            <p>อย่างที่เขาเคยได้ฝันไว้อีกครั้ง</p>
                        </div>
                        <a href="{{ Route('Home') }}"  class="z-[100] flex w-full justify-center rounded-full bg-[#E7B16A] hover:bg-[#dd8c32] px-3 py-1.5 leading-6 text-white border-2 border-white shadow duration-300">ช่วยผู้หลับใหลคนถัดไป</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL CONTENT -->
    </div>
    <!-- END MODAL LOGIN -->

    
    <!-- START MODAL IMAGE ZOOM -->
    <div id="modal-image-zoom" class="modal hidden fixed z-[100] left-0 top-0 w-[100%] h-[100%] overflow-auto">
        <!-- Modal content -->
        <div class="modal-content fixed inset-0 flex items-center justify-center p-[10px]">
            <div class="relative w-[640px] h-auto max-h-[90vh] object-cover bg-[#e6e4f0] rounded-2xl overflow-hidden">
                <span id="icon-image-zoom-close" class="text-black bg-white rounded-full drop-shadow border text-[24px] font-bold h-fit font-medium absolute top-0 right-0 mt-2 mr-2 hover:text-indigo-600 hover:bg-indigo-200 duration-300 cursor-pointer"><i class='bx bx-x'></i></span>
                <div class="w-auto h-auto flex justify-center border-2 rounded p-3">
                    <img id="image_zoom" src="{{ URL('/assets/mini-logo.png') }}" alt="" class="w-auto h-auto object-cover">
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL IMAGE ZOOM -->

@endsection

@push('script')
    <script src="{{ secure_asset('js/game/RoomPlay.js') }}" defer></script>
    <script>
        var isCreator = "<?php echo Session::get('creator') ?>";
        var room_id = "<?php echo $room->room_id ?>";
        var RoomStatus = "<?php echo $room->status ?>";
        var RoomRound = "<?php echo $room->round ?>";
        var RoomCircle = "<?php echo $room->circle ?>";
        var RuleCircle = "<?php echo $room->rule_circle ?>";
        var RuleRound = "<?php echo $room->level_round ?>";
        var Timeout = new Date('<?php echo $room->time ?>').getTime();
        var AmtNextCircle = "<?php echo $amt_next_circle ?>";
        var amtNMSelect = (AmtNextCircle == 5) ? 1 : 2;
        
        const RouteLeaveRoom = "<?php echo Route('LeaveRoom'); ?>";
        const RoutePollLinks = "<?php echo Route('PollLinks'); ?>";
        const RouteStartTimer = "<?php echo Route('StartTimer'); ?>";
        const RouteEndTimer = "<?php echo Route('EndTimer'); ?>";
        const RouteFetchTimeout = "<?php echo Route('FetchTimeout'); ?>";
        const RouteFetchCards = "<?php echo Route('FetchCards'); ?>";
        const RouteFetchResults = "<?php echo Route('FetchResults'); ?>";
        const RouteCardAdd = "<?php echo Route('CardAdd'); ?>";
        const RouteCheckNightmareLink = "<?php echo Route('CheckNightmareLink'); ?>";
        const RouteStartNextRound = "<?php echo Route('StartNextRound'); ?>";
        const RouteStartNextCircle = "<?php echo Route('StartNextCircle'); ?>";
        const RouteGameEnd = "<?php echo Route('GameEnd'); ?>";
        const RouteUpdateStats = "<?php echo Route('UpdateStats'); ?>";
    </script>
@endpush