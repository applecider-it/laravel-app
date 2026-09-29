<?php

namespace App\Services\Data;

use Illuminate\Http\File as HttpFile;

/**
 * ファイル関連
 */
class File
{
    /** DataUrl生成 */
    public static function createDataUrl(string $filePath)
    {
        $mime = (new HttpFile($filePath))->getMimeType();

        // バイナリ取得
        $data = file_get_contents($filePath);

        // base64エンコード
        $base64 = base64_encode($data);

        $src = "data:$mime;base64,$base64";

        return compact('src', 'mime');
    }
}
