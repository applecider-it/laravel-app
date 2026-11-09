<x-app-layout>
    @vite(['resources/js/entrypoints/chat-echo.ts'])

    <div class="app-container-normal">
        <h2 class="app-h2">Chat Echo ( room: {{ $rooms[$room] }} )</h2>

        <div class="space-x-4">
            @foreach ($rooms as $key => $val)
                @if ($key === $room)
                    <span>{{ $val }}</span>
                @else
                    <a href="{{ route('chat_echo.index', ['room' => $key]) }}" class="app-link-normal">{{ $val }}</a>
                @endif
            @endforeach
        </div>

        <div class="my-4">
            <div id="chat-root" data-all="{{ json_encode([
                'room' => $room,
            ]) }}">
                @include('partials.message.loading')
            </div>
        </div>
    </div>
</x-app-layout>
