<x-app-layout>
    <x-slot name="header">
        <h2 class="app-header-title">
            投稿
        </h2>
    </x-slot>

    <div class="app-container">
        <div class="space-y-4">
            @foreach ($posts as $post)
                <a href="{{ route('posts.show', ['slug' => $post->slug]) }}">
                <div class="border-2 rounded p-4 text-gray-800">
                    <div class="p-4">{{ $post->title }}</div>
                    <div class="text-sm text-gray-400 text-right">{{ $post->published_at }}</div>
                </div>
                        </a>
            @endforeach

            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
