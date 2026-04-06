<?php

namespace App\Services\Development;

use Illuminate\Support\Facades\Log;
use App\Services\AI\AiService;

/**
 * AIテスト
 */
class AiTestService
{
    public function __construct(
        private AiService $aiService,
    ) {}

    /**
     * AIテスト実行
     */
    public function execAiTest($file)
    {
        [$width, $height] = getimagesize($file->getRealPath());

        $response = $this->aiService->imageAnalysis($file->getRealPath());

        Log::info("AI Response", [$response]);

        // バイナリ取得
        $data = file_get_contents($file->getRealPath());

        // base64エンコード
        $base64 = base64_encode($data);

        // MIMEタイプ取得
        $mime = $file->getMimeType();

        $src = "data:$mime;base64,$base64";

        $info = compact('width', 'height', 'mime');
        $results = $response['result']['results'];

        return compact('src', 'results', 'info');
    }
}
