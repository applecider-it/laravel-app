<div class="justify-between hidden md:flex">
    <div>
        {{ $paginator->total() }}
        ( {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }} )
    </div>

    <div>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span>
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="app-link-normal">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Pagination Elements --}}
        <span class="mx-3">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    {{ $element }}
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span>
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="app-link-normal">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="app-link-normal">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span>
                {!! __('pagination.next') !!}
            </span>
        @endif

    </div>
</div>