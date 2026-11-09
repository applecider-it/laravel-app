<x-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">開発者向けページ</h2>

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
            <div>
                <p><a href="{{ route('development.security') }}" class="app-link-normal">security</a></p>
                <p><a href="{{ route('development.verified') }}" class="app-link-normal">verified</a></p>
            </div>

            <div class="app-pwa:hidden">
                <div><a href="{{ route('appli.start') }}" class="app-link-normal">appli.start</a></div>
            </div>
        </div>
    </div>
</x-app-layout>
