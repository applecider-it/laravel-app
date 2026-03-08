<?php

namespace App\Services\Admin\Post;

use App\Models\Post;

/**
 * 管理画面のユーザー管理の一覧関連
 */
class ListService
{
    /**
     * 一覧用のリストオブジェクト
     */
    public function getPosts(?string $search)
    {
        $query = Post::query();

        $query->latest();

        // フリーワード検索
        if ($search) $query->searchKeyword($search);

        return $query;
    }
}
