<x-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">メール認証必須ページ</h2>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            ご登録ありがとうございます！利用を開始する前に、先ほどお送りしたメール内のリンクをクリックして、メールアドレスの認証をお願いいたします。もしメールが届いていない場合は、改めてお送りしますのでお知らせください。
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                登録時にご指定いただいたメールアドレスへ、新しい認証用リンクを送信しました。
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button type="submit" class="app-btn-primary">送信</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
