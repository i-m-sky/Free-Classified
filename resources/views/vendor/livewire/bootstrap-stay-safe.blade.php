<div class="pages-container dash-pages stay-safe">
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))
        <div class="total-views">

            {{-- Showing  --}}

            <b>{{ $paginator->firstItem() }}</b>
            {{-- to
            <b>{{ $paginator->lastItem() }}</b> --}}
            of
            <b>{{ $paginator->total() }}</b>
            {{--             
            {!! __('results') !!} --}}
        </div>
        <ul class="pages-num">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled prev" disabled aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <button type="button"
                        dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        class="page-link prev" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')"><i
                            class="fa fa-chevron-left" aria-hidden="true"></i>
                    </button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                {{-- @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span
                            class="page-link">{{ $element }}</span></li>
                @endif --}}

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"
                                wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                                aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            @if (in_array($page, range($paginator->currentPage() - 2, $paginator->currentPage() + 2)))
                                <li class="page-item"
                                    wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                                    <button type="button" class="page-link"
                                        wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                                </li>
                            @else
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button type="button"
                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        class="page-link next" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')"> <i
                            class="fa fa-chevron-right" aria-hidden="true"></i></button>
                </li>
            @else
                <li class="page-item disabled next" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true"><i class="fa fa-chevron-right"
                            aria-hidden="true"></i></span>
                </li>
            @endif
        </ul>

    @endif
</div>
