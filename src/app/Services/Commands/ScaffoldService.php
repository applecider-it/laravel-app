<?php

namespace App\Services\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Scaffold
 */
class ScaffoldService
{
    private Command $cmd;

    public function __construct() {}

    /**
     * 実行
     */
    public function exec(Command $cmd)
    {
        $this->cmd = $cmd;

        $force = $this->cmd->option('force');
        $dryrun = $this->cmd->option('dryrun');

        // スネークケース
        $nameSnake = Str::singular(Str::snake($this->cmd->argument('name')));
        // パスカルケース
        $nameStudly = Str::studly($nameSnake);
        $nameStudlyPlural = Str::plural($nameStudly);
        // キャメルケース
        $nameCamel = Str::camel($nameSnake);
        $nameCamelPlural = Str::plural($nameCamel);

        $arr = explode(',', $this->cmd->argument('columns'));
        $columns = array_map(fn($val) => [
            'snake' => Str::snake($val),
            'studly' => Str::studly($val),
        ], $arr);

        // 出力対象
        $list = [
            [
                'view' => 'generators.scaffold.controller',
                'path' => base_path('app/Http/Controllers/' . $nameStudly . 'Controller.php'),
            ],
            [
                'view' => 'generators.scaffold.model',
                'path' => base_path('app/Models/' . $nameStudly . '.php'),
            ],
        ];

        $this->cmd->info('force: ' . json_encode($force));
        $this->cmd->info('dryrun: ' . json_encode($dryrun));
        $this->cmd->info("nameSnake: {$nameSnake}");
        $this->cmd->info("nameStudly: {$nameStudly}");
        $this->cmd->info("nameCamel: {$nameCamel}");
        $this->cmd->info("nameStudlyPlural: {$nameStudlyPlural}");
        $this->cmd->info("nameCamelPlural: {$nameCamelPlural}");
        $this->cmd->info('columns: ' . json_encode($columns));
        $this->cmd->info('list: ' . json_encode($list, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        $replace = compact(
            'nameSnake',
            'nameStudly',
            'nameCamel',
            'nameStudlyPlural',
            'nameCamelPlural',
            'columns',
        );

        $this->buildAll($list, $replace, $force, $dryrun);
    }

    /** 対象ファイル全て生成 */
    private function buildAll($list, $replace, $force, $dryrun)
    {
        foreach ($list as $row) {
            $view = $row['view'];
            $path = $row['path'];

            $this->cmd->info('Build file');
            $this->cmd->info('view: ' . $view);
            $this->cmd->info('path: ' . $path);

            $data = (string) view($view, $replace);

            $data = str_replace(['<#', '#>'], ['<?', '?>'], $data);

            if ($dryrun) {
                // ドライランの時

                echo $data . PHP_EOL;
            } else {
                // ファイル生成の時

                if (file_exists($path) && !$force) {
                    // ファイルがあり、強制出力じゃないとき

                    $this->cmd->warn('The file exists.');
                } else {
                    file_put_contents($path, $data);
                }
            }
        }
    }
}
