# websocket連携

## 独自実装

websocketはnodeで連携する。

認証はJWTを使う。

Redis Pub/Sub連携のみで動作する。

## 処理の流れ

```
Laravelに送信
 ↓
LaravelからRedisにPublish
 ↓
WebSocketサーバーがSubscribe
 ↓
WebSocketサーバーが同じチャンネルのユーザー全てに送信
```

## ユーザー一覧管理

- WebSocketサーバーが複数でも同期が取れるようにしている。

- ユーザー一覧は、redis経由で、WebSocketサーバーの変数に蓄積される。

#### 接続時、切断時の流れ

```
クライアントが接続や切断をする
 ↓
接続しているWebSocketサーバーに送信が行く
 ↓
WebSocketサーバーから接続切断情報をRedisにPublish
 ↓
全WebSocketサーバーがSubscribeし、それぞれのサーバーで変数が変更される。
```

## チャンネル名の定義

`channelname:param1,param2...`

## コネクション時のパラメーター

| 項目名 | 内容 | 型 | 詳細 |
|--------|--------|--------|--------|
| token | 認証情報を含むJWTトークン | string |  |

## token

| 項目名 | 内容 | 型 | 詳細 |
|--------|--------|--------|--------|
| id | ID | integer | ユーザーID |
| name | 表示名 | string |  |
| channel | 接続するチャンネル | string | つまり、同時に複数のチャンネルには接続できない。 |
| iat | 現在日時 | integer |  |
| exp | 有効期限 | integer |  |

## Redis Pub/Sub連携メッセージ送信時

Pub/Subのチャンネル名: `[redis_prefix]broadcast`

```
{
  channel: string, <- WebSocketチャンネル名
  data: hash,
  type: 'message',
}
```

### チャットの場合のdata

```
{
  message: string,
  name: string,
}
```

### Tweetの場合のdata

```
{
  tweet: {
    id: integer,
    content: string,
    created_at: string,
    user: {
      id: integer,
      name: string,
    }
  },
}
```

## ブロードキャスト時のレスポンス

```
{
  type: 'message',
  data: hash, <- メッセージ送信時と同じ
}
```

## 接続時に自分に送信

```
{
  type: 'connected',
  users: [
    {
      id: number,
      name: string,
    },
    .
    .
  ],
}
```

## 接続時にブロードキャスト

```
{
  type: 'connectOther',
  data: {
    user: {
      name: string,
      id: number,
    }
  }
}
```

## 切断時にブロードキャスト

```
{
  type: 'disconnectOther',
  data: {
    user: {
      name: string,
      id: number,
    }
  }
}
```



