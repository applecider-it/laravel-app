# Laravel Echo

## ブロードキャスト時

### チャット

メッセージ名: `ChatMessageSent`

```
{
  message: string,
  user: {
    id: integer,
    name: string,
  }
}
```
