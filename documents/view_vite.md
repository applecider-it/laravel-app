# ViewとViteの橋渡し

## アプリケーション用のJSオブジェクト

```
window.App

window.App.funcs <- Viewから直接利用したい関数を登録する
```

直接JSで、ViteとViewの橋渡しをする。

## 意味のあるセレクタ

### [data-app-element-check-form-changes]

フォーム変更チェック

監視対象フォームに設置する

```
{
  type: string;
}
```

#### type

`on`: 有効化

`clear`: フォーム変更チェックのクリアのみ