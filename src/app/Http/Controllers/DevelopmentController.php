<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

use App\Services\WebSocket\AuthService as WebSocketAuthService;
use App\Services\Channels\ProgressChannel;
use App\Services\Sample\SampleService;
use App\Services\Development\TraceService;
use App\Services\Development\FormService;
use App\Services\AI\ImageAnalysisService;

use App\Events\SampleEvent;
use App\Jobs\SampleJob;

/**
 * 開発者向けページ用コントローラー
 */
class DevelopmentController extends Controller
{
    public function __construct(
        private SampleService $sampleService,
        private TraceService $traceService,
        private FormService $formService,
        private WebSocketAuthService $webSocketAuthService,
        private ImageAnalysisService $imageAnalysisService,
    ) {}

    public function index(Request $request)
    {
        return view('development.index');
    }

    /** phpテスト */
    public function php_test(Request $request)
    {
        $user = $request->user();

        $this->traceService->traceMiddlewareInfo();

        Redis::set('redis-test', 'TEST');

        event(new SampleEvent($user));

        $this->sampleService->testExec("php_test");

        return view('development.complate');
    }

    /** viewテスト */
    public function view_test(Request $request)
    {
        return view('development.view_test', $this->formService->formData());
    }

    /** viewテスト(POST処理) */
    public function view_test_post(Request $request)
    {
        return redirect()->back()->withInput();
    }

    /** javascriptテスト */
    public function javascript_test(Request $request)
    {
        return view(
            'development.javascript_test',
            ['formData' => $this->formService->formData()]
        );
    }

    /** uploadテスト */
    public function upload_test(Request $request)
    {
        $path = $request->file('file')->store('uploads');

        return response()->json(['path' => $path]);
    }

    /** websocketテスト */
    public function websocket_test(Request $request)
    {
        $user = $request->user();

        $token = $this->webSocketAuthService->createUserJwt($user, ProgressChannel::getChannel($user->id));
        return view(
            'development.websocket_test',
            compact('token')
        );
    }

    /**
     * スロージョブ開始
     */
    public function start_slow_job(Request $request)
    {
        $user = $request->user();

        $test = $request->input('test');
        $test2 = $request->input('test2');

        Log::info('startSlowJob', [$user->name, $test, $test2]);

        SampleJob::dispatch(date('H:i:s'), $user);

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * テストチャンネルにメッセージ送信
     */
    public function send_test_channel(Request $request)
    {
        $message = $request->input('message');
        $id = (int) $request->input('user_id');

        Log::info('sendTestChannel', [$message, $id]);

        event(new \App\Events\MessageSent($message, $id));

        return response()->json([
            'status' => true,
        ]);
    }

    /** routerテスト */
    public function router_test(Request $request)
    {
        return view(
            'development.router_test',
            ['name' => 'Router Test!!']
        );
    }

    /** aiテスト */
    public function ai_test(Request $request)
    {
        return view('development.ai_test', ['dataUrl' => null]);
    }

    /** aiテスト */
    public function ai_test_post(Request $request)
    {
        // バリデーション
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        $file = $request->file('file');

        return view(
            'development.ai_test',
            $this->imageAnalysisService->execAnalysisService($file->getRealPath())
        );
    }
}
