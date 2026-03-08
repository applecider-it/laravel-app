<x-admin-layout
    :breadcrumbs="['admin.posts.edit', $post]"
>
    <x-slot name="header">
        <h2 class="app-header-title">
            ユーザー編集
        </h2>
    </x-slot>

    <div class="app-container-lg">
        <div class="mb-6">
            <a href="{{ route('admin.posts.index') }}" class="app-btn-secondary">
                一覧に戻る
            </a>
        </div>

        @include('partials.form.errors')

        @include('partials.message.session')

        <form method="POST" action="{{ route('admin.posts.update', $post) }}" class="app-form">
            @csrf
            @method('PUT')

            @include('admin.posts.partials.form')

            <div>
                <label for="name" class="app-form-label">更新日時</label>
                {{ $post->updated_at }}
            </div>

            <div>
                <label for="name" class="app-form-label">削除日時</label>
                {{ $post->deleted_at }}
            </div>

            <div class="pt-4">
                <button type="submit" class="app-btn-primary">
                    更新
                </button>
            </div>
        </form>

        <div class="mt-20">
            <div class="flex justify-between items-center">
                <div>
                    削除
                </div>
                <div>
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('削除してもよろしいですか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="app-btn-danger">
                            削除
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
