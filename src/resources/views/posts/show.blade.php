<x-app-layout>
    <x-slot name="header">
        <h2 class="app-header-title">
            投稿
        </h2>
    </x-slot>

    <div class="app-container">
        <h3 class="text-4xl font-bold mb-4">
            {{ $post->title }}
        </h3>
        <div class="text-sm text-gray-400">
            {{ $post->published_at->format('Y-m-d H:i') }}
        </div>
        <div class="app-post-content-container mt-10">
            {!! $post->contentHtml() !!}
        </div>
    </div>
</x-app-layout>
