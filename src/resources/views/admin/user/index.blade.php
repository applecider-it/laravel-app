<x-admin-layout
    :breadcrumbs="['admin.users.index']"
>
    <div class="app-container-normal">
        <h2 class="app-h2">ユーザー一覧</h2>

        <div class="mb-4">
            <a href="{{ route('admin.users.create') }}" class="app-btn-primary">
                新規作成
            </a>
        </div>
        
        @include('admin.user.partials.search')

        @include('admin.user.partials.list')

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
