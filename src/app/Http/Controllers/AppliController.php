<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Services\Appli\AppliService;

/**
 * アプリコントローラー
 */
class AppliController extends Controller
{
    public function __construct() {}

    /** PWAマニフェスト */
    public function manifest(Request $request)
    {
        $manifest = AppliService::getPwaManifest();

        return response()
            ->json($manifest, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            ->header('Content-Type', 'application/json');
    }

    /** アプリ開始画面 */
    public function start(Request $request)
    {
        return view('appli.start');
    }
}
