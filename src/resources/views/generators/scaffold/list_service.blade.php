<#php

namespace App\Services\{{ $nameStudly }};

use App\Models\{{ $nameStudly }};

/**
 * {{ $nameStudly }}の一覧関連
 */
class ListService
{
    /**
     * 一覧用のリストオブジェクト
     */
    public function get{{ $nameStudlyPlural }}(?string $search)
    {
        $query = {{ $nameStudly }}::query();

        $query->latest();

        // フリーワード検索
        if ($search) $query->searchKeyword($search);

        return $query;
    }
}
