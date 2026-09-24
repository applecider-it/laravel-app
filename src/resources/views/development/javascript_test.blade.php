<x-app-layout>
    <x-slot name="header">
        <h2 class="app-header-title">
            Javascript Test
        </h2>
    </x-slot>

    @vite(['resources/js/entrypoints/development/javascript-test.ts'])

    <div class="app-container">
        <div id="vue-test-root" data-all="{{ json_encode([
            'testValue' => 456,
            'formData' => [
                'list_val' => $formData['list_val'],
                'radio_val' => $formData['radio_val'],
                'datetime_val' => $formData['datetime_val'],
                'list_vals' => App\Services\Data\Arr::hashToMap($formData['list_vals']),
                'radio_vals' => App\Services\Data\Arr::hashToMap($formData['radio_vals']),
            ],
        ]) }}">
            @include('partials.message.loading')
        </div>
    </div>
</x-app-layout>
