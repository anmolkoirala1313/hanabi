@if ($paginator->hasPages())
    <nav class="center">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="theme-btn btn-style-one bg-theme-color4 mr-40 ml_sm--5 header-one-btn quote-btn disabled-button">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="page-item">
                    <a class="theme-btn btn-style-one ml--20 ml_sm--5" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="theme-btn btn-style-one ml--20 ml_sm--5 header-one-btn quote-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="theme-btn btn-style-one bg-theme-color4 mr-40 ml--20 ml_sm--5 header-one-btn quote-btn disabled-button">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
