@if ($paginator->hasPages())

        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="paginate_button page-item previous disabled" id="example1_previous">
                        <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">السابق</a>
                    </li>
                @else
                    <li class="paginate_button page-item previous" id="example1_previous">
                        <a href="{{ $paginator->previousPageUrl() }}" aria-controls="example1" data-dt-idx="0"
                           tabindex="0" class="page-link">السابق</a>
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
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0"
                                       class="page-link">{{$page}}</a>
                                </li>
                            @else
                                <li class="paginate_button page-item">
                                    <a href="{{$url}}" aria-controls="example1" data-dt-idx="1" tabindex="0"
                                       class="page-link">{{$page}}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="paginate_button page-item previous" id="example1_next">
                        <a href="{{ $paginator->nextPageUrl() }}" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">التالي</a>
                    </li>
                @else
                    <li class="paginate_button page-item previous disabled" id="example1_next">
                        <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">التالي</a>
                    </li>
                @endif
            </ul>
        </div>
@endif
