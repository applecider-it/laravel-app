<?php

namespace App\Services\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Services\AI\ImageAnalysisService;

/**
 * WebSocket関連のテスト用
 */
class AiTestService
{
    private Command $cmd;

    public function __construct(
        private ImageAnalysisService $imageAnalysisService,
    ) {}

    /**
     * 実行
     */
    public function exec(Command $cmd)
    {
        $this->cmd = $cmd;

        $path = storage_path('app/image.jpg');

        $this->cmd->info("path: {$path}");

        if (!is_file($path)) {
            $this->cmd->error("画像ファイルがありません。 {$path}");
            return;
        }

        $response = $this->imageAnalysisService->execAnalysisService($path);

        $this->cmd->info('response' . json_encode($response, JSON_UNESCAPED_UNICODE));
    }
}
