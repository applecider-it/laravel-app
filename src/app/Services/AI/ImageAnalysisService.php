<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;

/**
 * 画像解析管理
 */
class ImageAnalysisService
{
    /** ファイルオブジェクトから画像解析実行 */
    public function execAnalysisService(UploadedFile $file)
    {
        [$width, $height] = getimagesize($file->getRealPath());

        $response = $this->sendImageAnalysisApi($file->getRealPath());

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

        $list = $this->appendCalculatedValues($results, $info);

        return compact('src', 'list', 'response', 'info');
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
