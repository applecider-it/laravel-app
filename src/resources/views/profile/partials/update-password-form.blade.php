<div class="space-y-6">
    <h3 class="app-h3">
        パスワード更新
    </h3>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="app-form-label">{{ __('app.columns.current_password') }}</label>

            <input id="update_password_current_password" name="current_password" type="password" class="app-form-input mt-1"/>

            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <label for="update_password_password" class="app-form-label">{{ __('app.models.user.columns.password') }}</label>

            <input id="update_password_password" name="password" type="password"
                class="app-form-input mt-1"/>

            <x-input-error :messages="$errors->updatePassword->get('password')" />
         </div>

        <div>
            <label for="update_password_password_confirmation" class="app-form-label">{{ __('app.columns.confirm_password') }}</label>

            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="app-form-input mt-1"/>

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="app-btn-primary">保存</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</div>
