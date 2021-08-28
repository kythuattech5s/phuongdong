@if ($paginator->hasPages())
    <div class="pagenigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <strong class="page-items active"><i class="fa fa-chevron-left" aria-hidden="true"></i></strong>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" title="" class="page-items"><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
            
            <a href="{{ $paginator->url(1)}}" title="" class="page-items">1</a>
            @if($paginator->currentPage() !== 2 && $paginator->url(2) !== null && $paginator->currentPage() !== 3)
            <a href="{{ $paginator->url(2)}}" title="" class="page-items">2</a>
            @endif
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="middle-pagination"> ... </a>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <strong class="page-items active">{{ $page }}</strong>
                    @elseif ($page == $paginator->currentPage() + 1  || $page == $paginator->lastPage() || ($page == $paginator->lastPage() - 1 && $page == 2))
                        <a href="{{ $url }}" class="page-items">{{ $page }}</a></li>
                    @elseif($page === $paginator->currentPage() +2)
                        <a class="middle-pagination"> ... </a>
                    @elseif(($page == $paginator->currentPage() - 1  && $page !==2) && $paginator->currentPage() > 2)
                        <a href="{{ $url }}" class="page-items">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" title="" class="page-items"> <i class="fa fa-chevron-right" aria-hidden="true"></i> </a>
        @else
            <strong class="page-items active"> <i class="fa fa-chevron-right" aria-hidden="true"></i></strong>
        @endif
    </div>
@endif
