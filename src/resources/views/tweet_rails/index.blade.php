<x-app-layout>
    <x-slot name="header">
        <h2 class="app-header-title">
            Tweet (Railsライク)
        </h2>
    </x-slot>

    @include('partials.message.session')

    <div class="app-container">
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
