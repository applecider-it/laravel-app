<x-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">パスワード再発行</h2>

        <div class="mb-4 text-sm text-gray-600">
            パスワードをお忘れですか？ご安心ください。メールアドレスをお知らせいただければ、新しいパスワードを設定するためのリンクをメールでお送りします。
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="app-form-label">{{ __('app.models.user.columns.email') }}</label>

                <input id="email" name="email" type="text" value="{{ old('email') }}" class="app-form-input mt-1"/>

                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="app-btn-primary">送信</button>
            </div>
        </form>
    </div>
</x-app-layout>
