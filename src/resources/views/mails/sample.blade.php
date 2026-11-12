<x-mail::message>

# サンプルメール

{{ $user->name }} 様

サンプルメールです。

<x-mail::panel>
**登録情報**

- 名前：{{ $user->name }}
- メールアドレス：{{ $user->email }}
</x-mail::panel>

以上。

{{ config('app.name') }}

</x-mail::message>
