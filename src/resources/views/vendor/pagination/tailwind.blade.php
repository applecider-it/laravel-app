@if ($paginator->hasPages())
    <nav class="my-10">
        @include('vendor.pagination.tailwind.responsive')

        @include('vendor.pagination.tailwind.primary')
    </nav>
@endif
