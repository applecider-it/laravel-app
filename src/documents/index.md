# Laravelモノリス

- [設計](./design.md)

## 実装内容

- [ツイート機能](./features/tweet.md)
- [チャット](./features/chat.md)

## モデル

`id`, `created_at`, `updated_at`, `deleted_at`の説明は省略しています。

カラムごとのvalidationは再利用しやすいようにモデルにまとめています。

- [ユーザー](./Models/User.md)
  - [ユーザーツイート](./Models/User/Tweet.md)
- [管理者](./Models/AdminUser.md)

## 細かいツール

- フォーム変更チェック
- クリップボード
- PWAのトップ画面
- PWAの表示切替
- Tailwindの特殊な利用例
- ページ遷移しない独自ルーター
- スロージョブ
- 独自Scaffold
- Railsライクな実装例
- JSからのファイルアップロード
- 画像解析

## その他

- [不具合](./error.md)
