<x-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">Tweet新規作成</h2>

        <form action="{{ route('tweet.store') }}" method="POST" class="mb-4" data-app-element-require-dirtycheck="on">
            @csrf
            <textarea name="content" rows="3" class="w-full border rounded-sm p-2" placeholder="What's happening?">{{ old('content') }}</textarea>
            <x-input-error :messages="$errors->get('content')" />

            <button type="submit" class="mt-2 app-btn-primary" name="confirm" value="on">確認</button>
        </form>
    </div>
</x-app-layout>
