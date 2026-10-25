<x-app-layout>
    <x-slot name="header">
        <h2 class="app-header-title">
            開発者向けページ
        </h2>
    </x-slot>

    <div class="app-container">
        <div class="space-y-5">
            <div>
                <p><a href="{{ route('development.php_test') }}" class="app-link-normal">php_test</a></p>
                <p><a href="{{ route('development.view_test') }}" class="app-link-normal">view_test</a></p>
                <p><a href="{{ route('development.javascript_test') }}" class="app-link-normal">javascript_test</a></p>
            </div>
            <div>
                <p><a href="{{ route('development.router_test') }}" class="app-link-normal">router_test</a></p>
                <p><a href="{{ route('development.ai_test') }}" class="app-link-normal">ai_test</a></p>
            </div>

            <div class="app-pwa:hidden">
                <div><a href="{{ route('appli') }}" class="app-link-normal">appli</a></div>
            </div>
        </div>
    </div>
</x-app-layout>
