<x-mail::message>

# ユーザー情報が更新されました

{{ $user->name }} 様

ユーザー情報が正常に更新されました。

<x-mail::panel>
**登録情報**

- 名前：{{ $user->name }}
- メールアドレス：{{ $user->email }}
</x-mail::panel>

ご確認よろしくお願いいたします。

{{ config('app.name') }}

</x-mail::message>
