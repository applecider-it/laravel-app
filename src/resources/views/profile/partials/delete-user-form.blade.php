<div class="space-y-6">
    <h3 class="app-h3">
        アカウント削除
    </h3>

    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <div class="mt-6">
            <label class="app-form-label">パスワード</label>

            <input id="password" name="password" type="password"
                class="app-form-input mt-1 w-3/4"/>

            <x-input-error :messages="$errors->userDeletion->get('password')" />
        </div>

        <div class="mt-6">
            <button type="submit" class="app-btn-danger">
                アカウント削除
            </button>
        </div>
    </form>
</div>
