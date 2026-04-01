<?php

namespace App\Services\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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
        $nameSnakePlural = Str::plural($nameSnake);
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
            [
                'view' => 'generators.scaffold.list_service',
                'path' => base_path('app/Services/' . $nameStudly . '/ListService.php'),
            ],

            // View
            [
                'view' => 'generators.scaffold.view.index',
                'path' => base_path('resources/views/' . $nameSnake . '/index.blade.php'),
            ],
            [
                'view' => 'generators.scaffold.view.edit',
                'path' => base_path('resources/views/' . $nameSnake . '/edit.blade.php'),
            ],
            [
                'view' => 'generators.scaffold.view.create',
                'path' => base_path('resources/views/' . $nameSnake . '/create.blade.php'),
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

        $this->showRemainingWork($nameSnakePlural, $nameStudly, $columns);
    }

    /** 対象ファイル全て生成 */
    private function buildAll($list, $replace, $force, $dryrun)
    {
        foreach ($list as $row) {
            $view = $row['view'];
            $path = $row['path'];
            $dir = dirname($row['path']);

            $this->cmd->info('Build file');
            $this->cmd->info('view: ' . $view);
            $this->cmd->info('path: ' . $path);
            $this->cmd->info('dir: ' . $dir);

            $data = (string) view($view, $replace);

            $data = $this->convertData($data);

            if ($dryrun) {
                // ドライランの時

                echo $data . PHP_EOL;
            } else {
                // ファイル生成の時

                if (file_exists($path) && !$force) {
                    // ファイルがあり、強制出力じゃないとき

                    $this->cmd->warn('The file exists.');
                } else {
                    // ディレクトリがない場合は作る
                    if (!file_exists($dir)) File::makeDirectory($dir);

                    file_put_contents($path, $data);
                }
            }
        }
    }

    /** Viewから取得した変数を実際の値に変換 */
    private function convertData($data)
    {
        $pattens = [
            '<#' => '<?',
            '#>' => '?>',
            '#}' => '}}',
            '{#' => '{{',
            '##' => '@',
            '<x#' => '<x',
            '</x#' => '</x',
        ];

        return str_replace(array_keys($pattens), array_values($pattens), $data);
    }

    /** 残り作業表示 */
    private function showRemainingWork($nameSnakePlural, $nameStudly, $columns)
    {
        $this->cmd->warn('残作業' . PHP_EOL);

        $this->cmd->info("migration生成" . PHP_EOL);
        $this->cmd->info("php artisan make:migration create_{$nameSnakePlural}_table" . PHP_EOL);

        $this->cmd->info("migrationに追記" . PHP_EOL);
        foreach ($columns as $column) {
            $this->cmd->info('$table->string(\'' . $column['snake'] . '\');');
        }

        $this->cmd->info(PHP_EOL . "ルート追加" . PHP_EOL);
        $this->cmd->info('use App\\Http\\Controllers\\' . $nameStudly . 'Controller;' . PHP_EOL);
        $this->cmd->info("Route::resource('{$nameSnakePlural}', {$nameStudly}Controller::class)->except(['show']);" . PHP_EOL);
    }
}
