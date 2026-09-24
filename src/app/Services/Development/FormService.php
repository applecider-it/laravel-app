<?php

namespace App\Services\Development;

/**
 * 開発者向けページのFormテスト管理
 */
class FormService
{
    /** テスト用フォームデータ */
    public function formData()
    {
        $list_val = 2;
        $radio_val = 'val2';
        $datetime_val = '2026-02-15T14:30';
        $list_vals = [
            1 => 'No. 1',
            2 => 'No. 2',
            3 => 'No. 3',
        ];
        $radio_vals = [
            'val1' => 'Value 1',
            'val2' => 'Value 2',
        ];
        return compact(
            'list_val',
            'radio_val',
            'datetime_val',
            'list_vals',
            'radio_vals'
        );
    }
}
