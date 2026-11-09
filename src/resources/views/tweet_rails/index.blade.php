<x-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">Tweet (Railsライク)</h2>

        <div class="mb-4">
            <a href="{{ route('tweet_rails.create') }}" class="app-btn-primary">
                新規作成
            </a>
        </div>
        
        <div class="space-y-4">
            @include('tweet_rails.partials.search')
            @include('tweet_rails.partials.list')
        </div>
    </div>
</x-app-layout>
