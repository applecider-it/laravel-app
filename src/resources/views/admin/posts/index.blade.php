<x-admin-layout
    :breadcrumbs="['admin.posts.index']"
>
    <x-slot name="header">
        <h2 class="app-header-title">
            ユーザー一覧
        </h2>
    </x-slot>

    <div class="app-container-lg">
        <div class="mb-4">
            <a href="{{ route('admin.posts.create') }}" class="app-btn-primary">
                新規作成
            </a>
        </div>

        @include('partials.message.session')
        
        @include('admin.posts.partials.search')

        @include('admin.posts.partials.list')

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-admin-layout>
