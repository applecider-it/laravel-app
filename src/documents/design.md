# 設計

## アプリケーション構成

- Laravelをモノリスにする。

- websocketはnodejsのマイクロサービス。

  - Node WebSocketサーバーは、`microservices`のサーバーを起動する必要がある。

- aiはpythonのマイクロサービス。

  - aiサーバーは、`microservices`のサーバーを起動する必要がある。

- Laravel Echoではsoketiを利用している。

  - soketiは、`microservices`のサーバーを起動する必要がある。

- アプリ化対応はPWA。

## モノリス概要

MVCSにして、ビジネスロジックは、カテゴリーごとにフォルダを分けたサービスクラスにまとめている。

javascriptを使わないでtypescriptだけ利用している。

インタラクティブな部分は、vueをアイランドアーキテクチャで利用している。

## 通常のLaravel以外の構成

```
app/
  Http/
    Controllers/
      Admin/ <- 独自実装の管理画面
      TweetController.php <- UserTweetController.phpにしないで、Tweetというドメインを表すようにしている。
      .
      .
      .
  Models/
    User/
      Tweet.php <- サブテーブルは、階層的に配置
    User.php
      .
      .
      .
  Services/ <- ビジネスロジックなど
    (カテゴリーごとにディレクトリを分けて、そのなかにサービスクラスを配置している)
    Admin/ <- 管理画面関連
    Channels/ <- WebSocketチャンネル関連
    Sample/ <- サービスクラス実装例
    .
    .
    .

config/
  myapp.php <- アプリケーション独自の設定ファイル

documents/ <- Laravelモノリス固有のドキュメント

lang/
  ja/
    app.php <- アプリケーション独自の言語ファイル

resources/
  js/
    entrypoints/ <- エントリーポイント
    services/ <- ビジネスロジックなど
      (カテゴリーごとにディレクトリを分けて、そのなかにサービスクラスを配置している)
    types/ <- グローバルな型情報置き場
    (app.ts -> entrypointsに移動している)
  views/
    admin/ <- 独自実装の管理画面
    pwa/ <- pwa関連
    .
    .
    .
routes/
  admin_auth.php <- 独自実装の管理画面。web.phpから呼んでいる。
  admin.php <- 独自実装の管理画面。web.phpから呼んでいる。
    .
    .
    .
```


## その他の技術選択の理由

- 管理画面のパッケージは、ブラックボックスのため難しくなってくるので利用していない。

- Livewireは、使える人が少なく、潰しがきかなくて、できることに限界があるため利用していない。

- Inertiaは、Node SSRがあるとスレッドセーフの問題、ないとSEOがないため用途が限定されて潰しがきかないため、利用していない。
