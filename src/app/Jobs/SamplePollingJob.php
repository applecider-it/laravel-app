<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

use App\Services\Jobs\SamplePollingJobService;

use App\Models\User;

class SamplePollingJob implements ShouldQueue
{
    use Queueable;

    private SamplePollingJobService $samplePollingJobService;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $time,
        private User $user
    ) {
        $this->samplePollingJobService = app(SamplePollingJobService::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->samplePollingJobService->exec($this->time, $this->user);
    }
}
