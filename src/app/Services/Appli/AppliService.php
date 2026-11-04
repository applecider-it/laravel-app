<?php

namespace App\Services\Appli;

/**
 * アプリ管理
 */
class AppliService
{
    /** PWAのマニフェストJSON用の変数 */
    public static function getPwaManifest()
    {
        $manifest = [
            'name' => 'Laravel Test!!',
            'icons' => [
                [
                    'src' => '/favicon.svg',
                    'type' => 'image/svg+xml',
                    'sizes' => '512x512',
                ],
            ],
            'start_url' => '/appli',
            'display' => 'standalone',
            'scope' => '/',
            'description' => 'ララベルのテスト用',
            'theme_color' => 'white',
            'background_color' => 'blue',
        ];

        return $manifest;
    }
}
