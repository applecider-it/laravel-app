<?php

/**
 * アプリケーション独自の設定ファイル
 */

return [
    // 管理画面のURIのプレフィックス
    'admin_uri_prefix' => 'admin_secrettext',

    // WebSocketのJWT認証用のシークレットテキスト
    'ws_jwt_secret' => env('MYAPP_WS_JWT_SECRET'),

    // WebSocketサーバーのホスト名
    'ws_server_host' => env('MYAPP_WS_SERVER_HOST'),

    // WebSocketのRedisブロードキャスト用チャンネル
    'ws_broadcast_redis_publish_channel' => 'broadcast',

    // AIサーバーのホスト名
    'ai_server_host' => env('MYAPP_AI_SERVER_HOST'),

    // トレースで隠すキーリスト
    'trace_mask_keys' => [
        'password',
        'password_confirmation',
    ],
];
