@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">
                        <i class="bi-arrow-left"></i>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">
                        <i class="bi-arrow-left"></i>
                    </a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if(is_string($element))
                    <li class="page-item"><a class="page-link" href="#">{{ $element }}</a></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        <i class="bi-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" tabindex="-1">
                        <i class="bi-arrow-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
