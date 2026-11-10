<x-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">パスワード確認</h2>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            ここはアプリケーションのセキュアな領域です。先に進む前に、パスワードを確認してください。
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <label for="password" class="app-form-label">{{ __('app.models.user.columns.password') }}</label>

                <input id="password" name="password" type="password" class="app-form-input mt-1"/>

                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="app-btn-primary">確認</button>
            </div>
        </form>
    </div>
</x-app-layout>
