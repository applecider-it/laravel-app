# pythonマイクロサービス

AI関連のAPIを管理するサーバー

- [API](./api.md)

## その他

pythonでAIを使いたいときは、djangoをモノリスにしないで、rails, laravelをモノリスにして、APIからpythonを呼び出すほうが無難。(詳しくは、`django-test`参照)

さらに、AIは分離しやすい機能なので、マイクロサービスに適している。
