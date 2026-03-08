<?php
/**
 * アプリケーション独自の言語ファイル
 */

return [
    'models' => [
        'user' => [
            'name' => 'ユーザー',
            'columns' => [
                'name' => '名前',
                'email' => 'メールアドレス',
                'password' => 'パスワード',
            ]
        ],
        'user/tweet' => [
            'name' => 'ユーザーツイート',
            'columns' => [
                'content' => '投稿内容',
            ]
        ],
        'admin_user' => [
            'name' => '管理者',
            'columns' => [
                'name' => '管理者名',
                'email' => '管理者メールアドレス',
                'password' => '管理者パスワード',
            ]
        ],
        'post' => [
            'name' => '投稿',
            'columns' => [
                'title' => 'タイトル',
                'slug' => 'Slug',
                'content' => '投稿内容',
                'published_at' => '投稿日時',
            ]
        ],
    ],
    'columns' => [
        'current_password' => '現在のパスワード',
        'confirm_password' => 'パスワードの確認',
    ],
];
