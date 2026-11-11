<x-admin-layout
    :breadcrumbs="['admin.users.create']"
>
    <div class="app-container-normal">
        <h2 class="app-h2">ユーザー作成</h2>

        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="app-btn-secondary">
                一覧に戻る
            </a>
        </div>

        @include('partials.form.errors')

        <form method="POST" action="{{ route('admin.users.store') }}" class="app-form" data-app-element-require-dirtycheck="on">
            @csrf

            @include('admin.user.partials.form')

            <div class="pt-4">
                <button type="submit" class="app-btn-primary">
                    作成
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
