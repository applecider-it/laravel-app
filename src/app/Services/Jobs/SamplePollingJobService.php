<?php

namespace App\Services\Jobs;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Redis;

use App\Models\User;

class SamplePollingJobService
{
    private User $user;

    public function __construct(
        private SamplePollingJobService\ProgressService $progressService
    ) {}

    /**
     * サンプルジョブ実行
     */
    public function exec($time, User $user)
    {
        $this->user = $user;
        $this->progressService->setup($this->user);

        Log::info('SamplePollingJob: Begin!!! ' . $time . ' ' . $this->user->name);

        $this->progressService->checkPoint(0);

        $total = 50;
        $waitSecond = 0.3;

        for ($i = 0; $i < $total; $i++) {
            usleep(1000000 * $waitSecond);

            $this->progressService->checkPoint($i / $total);
        }

        $this->progressService->checkPoint(1);

        Log::info('SamplePollingJob: End!!! ' . $time . ' ' . $this->user->name);
    }
}
