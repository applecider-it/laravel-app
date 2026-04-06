<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;


/**
 * AI管理
 */
class AiService
{
    /**
     * 画像解析
     */
    public function imageAnalysis($path)
    {
        $host = config('myapp.ai_server_host');

        $response = Http::attach(
            'file',
            file_get_contents($path),
            'test.jpg'
        )->post("http://{$host}/detect");

        return $response->json();
    }
}
