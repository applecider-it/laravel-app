<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

use App\Services\Sample\SampleService;
use App\Services\Development\TraceService;
use App\Services\Development\FormService;
use App\Services\AI\ImageAnalysisService;
use App\Services\Jobs\SampleJobService\ProgressService;

use App\Jobs\SampleJob;

/** スレッドセーフ動作確認用カウンター */
class Counter
{
    public static int $count = 0;
}

/**
 * 開発者向けページ用コントローラー
 */
class DevelopmentController extends Controller
{
    public function __construct(
        private SampleService $sampleService,
        private TraceService $traceService,
        private FormService $formService,
        private ImageAnalysisService $imageAnalysisService,
        private ProgressService $progressService,
    ) {}

    public function index(Request $request)
    {
        return view('development.index');
    }

    /** phpテスト */
    public function php_test(Request $request)
    {
        $this->traceService->traceMiddlewareInfo();

        Redis::set('redis-test', 'TEST');

        $this->sampleService->testExec("php_test");

        Counter::$count++;

        Log::info("Counter", [Counter::$count]);

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

    /**
     * スロージョブ開始
     */
    public function start_slow_job(Request $request)
    {
        $user = $request->user();

        $test = $request->input('test');
        $test2 = $request->input('test2');

        Log::info('startSlowPorlingJob', [$user->name, $test, $test2]);

        $this->progressService->setup($user);
        $this->progressService->checkPoint(0);

        SampleJob::dispatch(date('H:i:s'), $user);

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * スロージョブ経過
     */
    public function start_slow_job_progress(Request $request)
    {
        $user = $request->user();

        $this->progressService->setup($user);
        $data = $this->progressService->get();

        return response()->json([
            'data' => $data,
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
