<x-app-layout>
    @vite(['resources/js/entrypoints/development/router-test.ts'])

    <div class="app-container-normal">
        <h2 class="app-h2">Router Test</h2>

        <div id="test-root" data-all="{{ json_encode([
            'name' => $name,
        ]) }}">
            @include('partials.message.loading')
        </div>
    </div>
</x-app-layout>
