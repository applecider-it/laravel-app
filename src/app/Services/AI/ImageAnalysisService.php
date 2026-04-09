<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Services\Data\File;

/**
 * 画像解析管理
 */
class ImageAnalysisService
{
    /** 画像ファイルから画像解析実行 */
    public function execAnalysisService(string $filePath)
    {
        $response = $this->sendImageAnalysisApi($filePath);

        Log::info("AI Response", [$response]);
        
        $results = $response['result']['results'];

        [$width, $height] = getimagesize($filePath);
        $info = compact('width', 'height');

        $list = $this->appendCalculatedValues($results, $info);

        $dataUrl = File::createDataUrl($filePath);

        return compact('dataUrl', 'list', 'response', 'info');
    }

    /** 結果に計算値を足す */
    private function appendCalculatedValues($results, $info)
    {
        $list = [];

        foreach ($results as $row) {
            $x1Ratio = $row['box']['x1'] / $info['width'];
            $y1Ratio = $row['box']['y1'] / $info['height'];
            $x2Ratio = $row['box']['x2'] / $info['width'];
            $y2Ratio = $row['box']['y2'] / $info['height'];

            $wRatio = $x2Ratio - $x1Ratio;
            $hRatio = $y2Ratio - $y1Ratio;

            $row['calculatedValues'] = compact('x1Ratio', 'y1Ratio', 'wRatio', 'hRatio');

            $list[] = $row;
        }

        return $list;
    }

    /** 画像解析API送信 */
    private function sendImageAnalysisApi($path)
    {
        $host = config('myapp.ai_server_host');

        $response = Http::attach(
            'file',
            file_get_contents($path),
            'test.jpg'
        )->post("http://{$host}/image_analysis");

        return $response->json();
    }
}
