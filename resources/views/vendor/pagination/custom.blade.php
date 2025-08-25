@if ($paginator->hasPages())
    <nav class="pagination">
        <ul class="pagination__list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="text-prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="#">
                        <svg class="icon-arrow-1">
                            <use
                                xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                        </svg>
                    </a>
                </li>
            @else
                <li class="text-prev">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <svg class="icon-arrow-1">
                            <use
                                xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active current" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="text-next">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <svg class="icon-arrow-1">
                            <use
                                xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                        </svg>
                    </a>
                </li>
            @else
                <li class="text-next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="#">
                    <svg class="icon-arrow-1">
                        <use
                            xlink:href="{{asset('images/icons.svg')}}#icon-arrow-1"></use>
                    </svg>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
