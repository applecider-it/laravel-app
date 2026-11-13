@php
$datClass = "py-2";
$spanClass = "border p-2 rounded-md";
$linkClass = "border bg-blue-200 p-2 rounded-md cursor-pointer";
$pageSpanClass = "border py-2 pl-3 pr-2 rounded-md";
$pageLinkClass = "border bg-blue-200 py-2 pl-3 pr-2 rounded-md cursor-pointer";
@endphp
<div class="justify-between hidden md:flex">
    <div class="text-gray-400">
        {{ $paginator->total() }}
        ( {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }} )
    </div>

    <div>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="{{ $spanClass }}">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="{{ $linkClass }}">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Pagination Elements --}}
        <span class="mx-3 space-x-1">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="{{ $datClass }}">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="{{ $pageSpanClass }}">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="{{ $pageLinkClass }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="{{ $linkClass }}">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="{{ $spanClass }}">
                {!! __('pagination.next') !!}
            </span>
        @endif

    </div>
</div>