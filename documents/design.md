# 設計

## 構成

Laravelをモノリスにする。

websocketはnodejsのマイクロサービス。

aiはpythonのマイクロサービス。

Laravel Echoではsoketiを利用している。

アプリ化対応はPWA。

```
node/ <- nodeマイクロサービス
  documents/ <- nodeマイクロサービス固有のドキュメント
python/ <- pythonマイクロサービス
  documents/ <- pythonマイクロサービス固有のドキュメント
soketi/ <- soketi起動用
  documents/ <- soketi関連のドキュメント
src/ <- Laravelモノリス
  documents/ <- Laravelモノリス固有のドキュメント
documents/ <- 全体のドキュメント
```
