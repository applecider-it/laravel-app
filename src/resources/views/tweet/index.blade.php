<x-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">Tweet</h2>

        <div class="mb-4">
            <a href="{{ route('tweet.create') }}" class="app-btn-primary">
                新規作成
            </a>
        </div>
        
        <div class="space-y-4">
            @include('tweet.partials.search')
            @include('tweet.partials.list')
        </div>
    </div>
</x-app-layout>
