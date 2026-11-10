<div>
    <label for="name" class="app-form-label">{{ __('app.models.user.columns.name') }}</label>
    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 app-form-input">
    <x-input-error :messages="$errors->get('name')" />
</div>

<div>
    <label for="email" class="app-form-label">{{ __('app.models.user.columns.email') }}</label>
    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 app-form-input">
    <x-input-error :messages="$errors->get('email')" />
</div>

<div>
    <label for="password" class="app-form-label">
        {{ __('app.models.user.columns.password') }}
        @if($user->exists)
            （変更する場合のみ）
        @endif
    </label>
    <input type="password" name="password" id="password" class="mt-1 app-form-input">
    <x-input-error :messages="$errors->get('password')" />
</div>

<div>
    <label for="password_confirmation" class="app-form-label">{{ __('app.columns.confirm_password') }}</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 app-form-input">
    <x-input-error :messages="$errors->get('password_confirmation')" />
</div>
