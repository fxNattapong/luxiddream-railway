@if(isset($data_paginate))
    <!-- resources/views/custom-pagination.blade.php -->

    @if ($data_paginate->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="relative flex items-center justify-between bg-gray-100 rounded-md  border border-gray-200 overflow-hidden">
            <ul class="pagination flex w-[100%] justify-center items-center">
                {{-- Previous Page Link --}}
                @if ($data_paginate->onFirstPage())
                    <li class="absolute left-0 inline-flex items-center p-2 text-sm font-medium text-rose-500 border-t-2 border-rose-600 cursor-default">
                        <span class="flex items-center text-[16px]">
                            <i class='bx bx-left-arrow-alt text-[16px]'></i>ก่อนหน้า
                        </span>
                    </li>
                @else
                    <a href="{{ $data_paginate->previousPageUrl() }}" rel="prev" class="absolute left-0 inline-flex items-center p-2 text-sm font-medium text-gray-500 border-t-2 border-gray-300 hover:bg-rose-100 hover:border-rose-600 hover:text-rose-600 focus:outline-none focus:ring ring-rose-300 focus:border-rose-300 active:text-rose-700 transition ease-in-out duration-150" aria-label="@lang('pagination.previous')">
                        <span class="flex items-center text-[16px]">
                            <i class='bx bx-left-arrow-alt text-[16px]'></i>ก่อนหน้า
                        </span>
                    </a>
                @endif

                {{-- Page Number Links --}}
                @php
                    $currentPage = $data_paginate->currentPage();
                    $lastPage = $data_paginate->lastPage();
                    $maxLinks = 3; // Maximum number of links to display in pagination
                    $halfMaxLinks = ceil($maxLinks / 2);
                    $start = max(1, min($currentPage - $halfMaxLinks, $lastPage - $maxLinks + 1));
                    $end = min($start + $maxLinks - 1, $lastPage);
                    $middleEllipsis = false;
                @endphp

                <div class="inline-flex">
                    @if ($start > 1)
                        <li>
                            <a href="{{ $data_paginate->url(1) }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 border-t-2 border-gray-300 hover:text-rose-600 hover:border-rose-600 focus:outline-none focus:ring ring-rose-300 focus:border-rose-300 active:border-rose-100 active:text-rose-700 transition ease-in-out duration-150">
                                1
                            </a>
                        </li>
                        @if ($start > 2)
                            <li>
                                <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 cursor-default leading-5">
                                    ...
                                </span>
                            </li>
                        @endif
                    @endif

                    @foreach (range($start, $end) as $page)
                        @if ($page == $currentPage)
                            <li>
                                <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-rose-600 border-t-2 border-rose-600">
                                    <p class="text-[16px]">{{ $page }}</p>
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $data_paginate->url($page) }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 border-t-2 border-gray-300 hover:text-rose-600 hover:border-rose-600 focus:outline-none focus:ring ring-rose-300 focus:border-rose-300 active:border-rose-100 active:text-rose-700 transition ease-in-out duration-150">
                                    <p class="text-[16px]">{{ $page }}</p>
                                </a>
                            </li>
                        @endif

                        @if ($page == $start + $maxLinks - 1 && $page < $lastPage - 1)
                            <li>
                                <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 cursor-default leading-5">
                                    <p class="text-[16px]">...</p>
                                </span>
                            </li>
                        @endif
                    @endforeach

                    @if ($end < $lastPage)
                        <li>
                            <a href="{{ $data_paginate->url($lastPage) }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 border-t-2 border-gray-300 hover:text-rose-600 hover:border-rose-600 focus:outline-none focus:ring ring-rose-300 focus:border-rose-300 active:bg-rose-100 active:text-rose-700 transition ease-in-out duration-150">
                                <p class="text-[16px]">{{ $lastPage }}</p>
                            </a>
                        </li>
                    @endif
                </div>

                {{-- Next Page Link --}}
                @if ($data_paginate->hasMorePages())
                    <a href="{{ $data_paginate->nextPageUrl() }}" rel="next" class="absolute right-0 inline justify-center items-center w-[78.78px] px-2 py-2 text-sm font-medium text-gray-500 border-t-2 border-gray-300 hover:bg-rose-100 hover:border-rose-600 hover:text-rose-600 focus:outline-none focus:ring ring-rose-300 focus:border-rose-300 active:text-rose-700 transition ease-in-out duration-150" aria-label="@lang('pagination.next')">
                        <span class="flex items-center text-[16px]">
                            ถัดไป<i class='bx bx-right-arrow-alt text-[16px]'></i>
                        </span>
                    </a>
                @else
                    <li class="absolute right-0 inline justify-center items-center w-[78.78px] px-2 py-2 text-sm font-medium text-rose-500 border-t-2 border-rose-600 cursor-default ">
                        <span class="flex items-center text-[16px]">
                            ถัดไป<i class='bx bx-right-arrow-alt text-[16px]'></i>
                        </span>
                    </li>
                @endif

                <!-- <div class="text-sm text-gray-500 leading-5">
                    Showing {{ $data_paginate->firstItem() }} to {{ $data_paginate->lastItem() }} of {{ $data_paginate->total() }} results
                </div> -->
            </ul>
        </nav>
    @endif
    
@endif