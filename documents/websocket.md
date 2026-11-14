# websocket連携

## 独自実装

websocketはnodeで連携する。

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
