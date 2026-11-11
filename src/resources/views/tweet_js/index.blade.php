<x-app-layout>
    @vite('resources/js/entrypoints/tweet.ts')

    <div class="app-container-normal">
        <h2 class="app-h2">Tweet</h2>

        <div
            id="tweet-app"
            data-all="{{ json_encode([
                'token' => $token,
                'wsHost' => config('myapp.ws_server_host'),
                'tweets' => $tweetsJsonArray,
            ]) }}">
            @include('partials.message.loading')
        </div>
    </div>
</x-app-layout>
