<?php

namespace App\Services\Jobs\SamplePollingJobService;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Redis;

use App\Models\User;

class ProgressService
{
    private User $user;

    public function __construct() {}

    /** セットアップ */
    public function setup(User $user)
    {
        $this->user = $user;
    }

    /** チェックポイント */
    public function checkPoint($i)
    {
        $key = $this->key();

        $data = [
            'cursor' => $i,
        ];

        Log::info('SamplePollingJob: checkPoint ' . $i . ' ' . $this->user->name . ' ' . $key, [$data]);

        Redis::set($key, json_encode($data));
        Redis::expire($key, 60);
    }

    /** データを返す */
    public function get()
    {
        $key = $this->key();

        $json = Redis::get($key);
        
        return $json ? json_decode($json, true) : null;
    }

    /** Redisのキー */
    private function key()
    {
        return 'SamplePollingJobService___' . $this->user->id;
    }
}
