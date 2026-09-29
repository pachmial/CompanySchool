@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Navigasi halaman">
        @if ($paginator->onFirstPage())
            <span class="pagination__btn pagination__btn--nav pagination__btn--disabled">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination__btn pagination__btn--nav">&lsaquo;</a>
        @endif

        @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
            <a href="{{ $url }}" class="pagination__btn {{ $page == $paginator->currentPage() ? 'pagination__btn--active' : '' }}">{{ $page }}</a>
        @endforeach

        @if ($paginator->hasMorePages())
            @if ($paginator->currentPage() + 2 < $paginator->lastPage())
                <span class="pagination__dots">&hellip;</span>
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="pagination__btn">{{ $paginator->lastPage() }}</a>
            @endif
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination__btn pagination__btn--nav">&rsaquo;</a>
        @else
            <span class="pagination__btn pagination__btn--nav pagination__btn--disabled">&rsaquo;</span>
        @endif
    </nav>
@endif