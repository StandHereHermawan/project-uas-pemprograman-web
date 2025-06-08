@php
    $currentPage = $paginator->currentPage(); // Halaman saat ini
    $lastPage = $paginator->lastPage();       // Halaman terakhir
@endphp

@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link text-dark">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link text-dark" href="{{ $paginator->previousPageUrl() }}"
                            rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link text-dark" href="{{ $paginator->nextPageUrl() }}"
                            rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link text-dark">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <ul class="pagination" style="
                                    --bs-border-color: var(--bs-red);
                                    --bs-pagination-active-bg: var(--bs-red); 
                                    --bs-pagination-active-border-color: var(--bs-red);
                                    --bs-pagination-hover-color: var(--bs-white);
                                    --bs-pagination-color: var(--bs-red);
                                    --bs-pagination-bg: var(--bs-body-bg);
                                    --bs-pagination-border-width: var(--bs-border-width);
                                    --bs-pagination-border-color: var(--bs-border-color);
                                    --bs-pagination-hover-bg: var(--bs-red);
                                    --bs-pagination-hover-border-color: var(--bs-border-color);
                                    --bs-pagination-focus-color: var(--bs-link-hover-color);
                                    --bs-pagination-focus-bg: var(--bs-secondary-bg);
                                    --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
                                    --bs-pagination-disabled-color: var(--bs-white);
                                    --bs-pagination-disabled-bg: var(--bs-red);
                                    --bs-pagination-disabled-border-color: var(--bs-border-color);
                                    ">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif
                    {{-- End of Previous Page Link --}}

                    {{-- Pagination Elements --}}
                    {{-- Page 1 --}}
                    @if ($currentPage > 2)
                        <li class="page-item">
                            <a href="{{ $paginator->url(1) }}" class="page-link">1</a>
                        </li>
                        @if ($currentPage > 3)
                            <li class="page-item">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                    @endif

                    {{-- One page before --}}
                    @if ($currentPage > 1)
                        <li class="page-item">
                            <a href="{{ $paginator->url($currentPage - 1) }}" class="page-link">{{ $currentPage - 1 }}</a>
                        </li>
                    @endif

                    {{-- Current page --}}
                    <li class="page-item">
                        <span class="font-bold page-link active">{{ $currentPage }}</span>
                    </li>

                    {{-- One page after --}}
                    @if ($currentPage < $lastPage)
                        <li class="page-item">
                            <a href="{{ $paginator->url($currentPage + 1) }}" class="page-link">{{ $currentPage + 1 }}</a>
                        </li>
                    @endif

                    {{-- Last page --}}
                    @if ($currentPage < $lastPage - 1)
                        @if ($currentPage < $lastPage - 2)
                            <li class="page-item">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a>
                        </li>
                    @endif
                    {{-- End of Pagination Elements --}}

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                    {{-- End of Next Page Link --}}
                </ul>
            </div>
        </div>
    </nav>
@endif