<section>
    <h3 class="app-h3">
        プロフィール情報
    </h3>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="app-form-label">{{ __('app.models.user.columns.name') }}</label>

            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="app-form-input mt-1"/>

            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="app-form-label">{{ __('app.models.user.columns.email') }}</label>

            <input id="email" name="email" type="text" value="{{ old('email', $user->email) }}" class="app-form-input mt-1"/>

            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        メールアドレスが未確認です。

                        <button form="send-verification" class="app-link-normal">
                            確認メールを再送信するには、ここをクリックしてください。
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            新しい認証リンクが、ご登録のメールアドレスに送信されました。
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="app-btn-primary">保存</button>

            @if (session('status') === 'profile-updated')
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
</section>
