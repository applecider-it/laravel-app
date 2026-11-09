<?php

namespace App\Services\Jobs;

use Illuminate\Support\Facades\Log;

use App\Models\User;

use App\Jobs\SampleJob;

/**
 * サンプルジョブの制御
 */
class SampleJobCtrlService
{
    private User $user;

    public function __construct(
        private SampleJobService\ProgressService $progressService
    ) {}

    /** セットアップ */
    public function setup(User $user)
    {
        $this->user = $user;

        $this->progressService->setup($user);
    }

    /**
     * サンプルジョブ開始
     */
    public function start()
    {
        $this->progressService->checkPoint(0);

        // SampleJobを経由して
        // SampleJobService::exec()が動作する
        SampleJob::dispatch(date('H:i:s'), $this->user);
    }

    /**
     * サンプルジョブ経過取得
     */
    public function progress()
    {
        return $this->progressService->get();
    }
}
