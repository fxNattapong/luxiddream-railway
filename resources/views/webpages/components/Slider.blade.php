@if($Pages)
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <div class="swiper rounded-md w-[880px] h-[500px] max-xl:w-[500px] max-xl:h-[300px] max-md:w-[300px] max-md:h-[200px]">
        <div class="swiper-wrapper">
            @foreach($Pages as $Page)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="overflow-hidden w-full h-auto">
                                <img src="{{ URL('/assets/images/' . $Page) }}" class="w-full h-full m-auto object-cover" alt="">
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
        <div class="swiper-button-prev hover:bg-gray-300 rounded-full p-8 duration-300" style="color: #6d6d6d"></div>
        <div class="swiper-button-next hover:bg-gray-300 rounded-full p-8 duration-300" style="color: #6d6d6d"></div>
        <div class="swiper-pagination mb-2" style="color: #454545;"></div>
        <div class="swiper-scrollbar" ></div>
    </div>
@endif

@push('script')
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="{{ URL('js/webpages/Swiper.js') }}" defer></script>
@endpush