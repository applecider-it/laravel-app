# 不具合

## SQLログとpailの併用で起きる不具合

`php artisan pail`とsqlログを併用すると、挙動がおかしくなる。

SqlLogServiceProviderを無効化するか、`pail`ではなく`tail -f`を使うと問題なく動く。

### 現象

- ページ遷移ごとにセッションが削除される。
- ログイン時に永久ループする。

### 原因

`Laravel\Pail\Handler`でAuthを使っているのが原因。
