@if ($paginator->hasPages())
    <div class="paginationGroup">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link pageLinkPrev">
                        <img src="{{ asset('images/icon/arrow-left.png') }}" alt="arrow left" class="img-fluid">
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link pageLinkPrev" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <img src="{{ asset('images/icon/arrow-left.png') }}" alt="arrow left" class="img-fluid">
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item">
                                <span class="page-link active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link pageLinkNext" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <img src="{{ asset('images/icon/arrow-right.png') }}" alt="arrow right" class="img-fluid">
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link pageLinkNext">
                        <img src="{{ asset('images/icon/arrow-right.png') }}" alt="arrow right" class="img-fluid">
                    </span>
                </li>
            @endif
        </ul>
    </div>
@endif
