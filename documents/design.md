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

## ディレクトリ構成

```
src/ <- Laravelモノリス
  documents/ <- Laravelモノリス固有のドキュメント
documents/ <- 全体のドキュメント
```
