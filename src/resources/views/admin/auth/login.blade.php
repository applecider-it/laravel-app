<x-admin-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">ログイン</h2>
            
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="app-form-label">{{ __('app.models.user.columns.email') }}</label>

                <input id="email" name="email" type="text" value="{{ old('email') }}" class="app-form-input mt-1"/>

                @error('email')
                    <p class="app-error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="app-form-label">{{ __('app.models.user.columns.password') }}</label>

                <input id="password" name="password" type="text" class="app-form-input mt-1"/>

                @error('password')
                    <p class="app-error-text">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded-sm dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-xs focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="app-btn-primary">
                    ログイン
                </button>
            </div>
        </form>
     </div>
</x-admin-layout>
