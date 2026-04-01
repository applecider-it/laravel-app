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
                        {name}
                        {columns}
                        {--force}
                        {--dryrun}
                        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold';

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
