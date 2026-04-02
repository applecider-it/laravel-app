<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\Commands\ScaffoldService;

class ScaffoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scaffold
                        {name : モデル名、コントローラー名}
                        {columns : カラム名。カンマ区切り}
                        {--force : 上書き許可}
                        {--dryrun : ドライラン}
                        {--display : 出力内容表示}
                        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CRUD生成';

    public function __construct(
        private ScaffoldService $scaffoldService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->scaffoldService->exec($this);
    }
}
