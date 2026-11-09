<x-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">パスワードリセット</h2>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email" class="app-form-label">{{ __('app.models.user.columns.email') }}</label>

                <input id="email" name="email" type="text" value="{{ old('email') }}" class="app-form-input mt-1"/>

                <x-input-error :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="app-form-label">{{ __('app.models.user.columns.password') }}</label>

                <input id="password" name="password" type="password" class="app-form-input mt-1"/>

                <x-input-error :messages="$errors->get('password')" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="app-form-label">{{ __('app.columns.confirm_password') }}</label>

                <input id="password_confirmation" name="password_confirmation" type="password" class="app-form-input mt-1"/>

                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="app-btn-primary">リセット</button>
            </div>
        </form>
    </div>
</x-app-layout>
