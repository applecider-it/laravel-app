<?php

namespace App\Services\Jobs\SampleJobService;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Redis;

use App\Models\User;

/**
 * サンプルジョブの経過管理
 */
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
    public function checkPoint(float $cursor, bool $complate)
    {
        $key = $this->key();

        $data = [
            'cursor' => $cursor,
            'complate' => $complate,
        ];

        Log::info('SampleJob: checkPoint ' . $cursor . ' ' . $this->user->name . ' ' . $key, [$data]);

        Redis::set($key, json_encode($data));
        //Redis::expire($key, 60);
    }

    /** クリア */
    public function clear()
    {
        $key = $this->key();

        Log::info('SampleJob: checkPoint: del ' . $key);
        Redis::del($key);
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
        return 'SampleJobService___' . $this->user->id;
    }
}
