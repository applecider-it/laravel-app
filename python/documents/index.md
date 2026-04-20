# pythonマイクロサービス

AI関連のAPIを管理するサーバー

- [API](./api.md)

## その他

djangoは、rails, laravelより実務では難しくなりやすい。

作りが独特で潰しがきかなくて、構造上コンフリクトしやすいなどがある。

pythonでAIを使いたいときは、djangoをモノリスにしないで、rails, laravelをモノリスにして、APIからpythonを呼び出すほうが無難。

さらに、AIは分離しやすい機能なので、マイクロサービスに適している。
