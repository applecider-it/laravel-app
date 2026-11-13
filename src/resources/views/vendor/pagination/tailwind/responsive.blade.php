@php
$cssSpan = "border p-3 rounded bg-gray-100";
$cssLink = "border p-3 rounded bg-blue-200";
@endphp
<div class="flex justify-between md:hidden">
    <div>
        @if ($paginator->onFirstPage())
            <span class="{{ $cssSpan }}">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="{{ $cssLink }}">
                {!! __('pagination.previous') !!}
            </a>
        @endif
    </div>

    <div class="text-gray-400">
        {{ $paginator->total() }}
        ( {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }} )
    </div>

    <div>
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="{{ $cssLink }}">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="{{ $cssSpan }}">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </div>
</div>