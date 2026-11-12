<?php

namespace App\Services\Data;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Paginator関連
 */
class Paginator
{
    /**
     * シンプルなページ情報を返す
     * 
     * paginatorのelementsだと、挙動が複雑なので、シンプルにしたいときに使う
     */
    public static function simpleElements(LengthAwarePaginator $paginator)
    {
        $size = $paginator->onEachSide ?? 3;
        $current = $paginator->currentPage();
        $limit = $paginator->lastPage();

        $start = $current - $size;
        $end = $current + $size;

        $dot = '...';

        $pages = [];
        for ($i = $start; $i <= $end ; $i++) {
            if ($i < 1) continue;
            if ($i > $limit) continue;
            $pages[$i] = $paginator->url($i);
        }

        $arr = [];
        if ($current - $size > 1) $arr[] = $dot;
        $arr[] = $pages;
        if ($current + $size < $limit) $arr[] = $dot;

        return $arr;
    }
}
