<x-app-layout>
    <x-slot name="header">
        <h2 class="app-header-title">
            投稿
        </h2>
    </x-slot>

    <div class="app-container">
        <div class="space-y-4">
            @foreach ($posts as $post)
                <div class="border rounded p-4">
                    <p class="text-gray-800">
                        <a href="{{ route('posts.show', ['slug' => $post->slug]) }}" class="app-link-normal">
                            {{ $post->title }}
                        </a>
                    </p>
                </div>
            @endforeach

            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
