<?php

namespace App\Services\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

/**
 * CRUD生成
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
        $display = $this->cmd->option('display');

        $info = $this->makeInfo();

        $list = $this->getList($info);

        $this->trace($force, $dryrun, $display, $info, $list);

        $this->buildAll($list, $info, $force, $dryrun, $display);

        $this->showRemainingWork($info);
    }

    /** 各種情報生成 */
    private function makeInfo()
    {
        // スネークケース
        $nameSnake = Str::singular(Str::snake($this->cmd->argument('name')));
        $nameSnakePlural = Str::plural($nameSnake);
        // パスカルケース
        $nameStudly = Str::studly($nameSnake);
        $nameStudlyPlural = Str::plural($nameStudly);
        // キャメルケース
        $nameCamel = Str::camel($nameSnake);
        $nameCamelPlural = Str::plural($nameCamel);

        // カラム情報
        $arr = explode(',', $this->cmd->argument('columns'));
        $columns = array_map(
            function ($val) {
                return [
                    'snake' => Str::snake($val),
                    'studly' => Str::studly($val),
                ];
            },
            $arr
        );

        return compact(
            'nameSnake',
            'nameStudly',
            'nameCamel',
            'nameSnakePlural',
            'nameStudlyPlural',
            'nameCamelPlural',
            'columns',
        );
    }

    /** 出力対象リスト */
    private function getList(array $info)
    {
        $nameStudly = $info['nameStudly'];
        $nameSnake = $info['nameSnake'];

        return [
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
            [
                'view' => 'generators.scaffold.view.partials.search',
                'path' => base_path('resources/views/' . $nameSnake . '/partials/search.blade.php'),
            ],
            [
                'view' => 'generators.scaffold.view.partials.list',
                'path' => base_path('resources/views/' . $nameSnake . '/partials/list.blade.php'),
            ],
            [
                'view' => 'generators.scaffold.view.partials.form',
                'path' => base_path('resources/views/' . $nameSnake . '/partials/form.blade.php'),
            ],
        ];
    }

    /** トレース */
    private function trace(bool $force, bool $dryrun, bool $display, array $info, array $list)
    {
        $this->cmd->info('force: ' . json_encode($force));
        $this->cmd->info('dryrun: ' . json_encode($dryrun));
        $this->cmd->info('display: ' . json_encode($display));
        $this->cmd->info('');

        $this->cmd->info("nameSnake: {$info['nameSnake']}");
        $this->cmd->info("nameStudly: {$info['nameStudly']}");
        $this->cmd->info("nameCamel: {$info['nameCamel']}");
        $this->cmd->info("nameSnakePlural: {$info['nameSnakePlural']}");
        $this->cmd->info("nameStudlyPlural: {$info['nameStudlyPlural']}");
        $this->cmd->info("nameCamelPlural: {$info['nameCamelPlural']}");
        $this->cmd->info('columns: ' . json_encode($info['columns']));
        $this->cmd->info('');

        $this->cmd->info('list: ' . json_encode($list, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $this->cmd->info('');
    }

    /** 対象ファイル全て生成 */
    private function buildAll(array $list, array $replace, bool $force, bool $dryrun, bool $display)
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

            if ($display) {
                // 出力内容表示する時

                echo $data . PHP_EOL;
            }

            if ($dryrun) {
                // ドライランの時

                $this->cmd->warn('dryrun');
            } else {
                // ファイル生成の時

                if (file_exists($path) && !$force) {
                    // ファイル生成できないとき

                    $this->cmd->warn('The file exists.');
                } else {
                    // ファイル生成できるとき

                    // ディレクトリがない場合は作る
                    if (!file_exists($dir)) File::makeDirectory($dir);

                    file_put_contents($path, $data);
                }
            }
        }
    }

    /** Viewから取得した変数を実際の値に変換 */
    private function convertData(string $data): string
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
    private function showRemainingWork(array $info)
    {
        $nameSnake = $info['nameSnake'];
        $nameSnakePlural = $info['nameSnakePlural'];
        $nameStudly = $info['nameStudly'];
        $columns = $info['columns'];

        $this->cmd->info(PHP_EOL);

        $this->cmd->warn('# 残作業' . PHP_EOL);

        // migrationの説明

        $this->cmd->info("# migration生成" . PHP_EOL);
        $this->cmd->info("php artisan make:migration create_{$nameSnakePlural}_table" . PHP_EOL);

        $this->cmd->info("# migrationに追記" . PHP_EOL);
        foreach ($columns as $row) {
            $this->cmd->info('$table->string(\'' . $row['snake'] . '\');');
        }
        $this->cmd->info("");

        $this->cmd->info("# migration実行" . PHP_EOL);
        $this->cmd->info("php artisan migrate" . PHP_EOL);

        // ルートの説明

        $this->cmd->info("# ルート追加" . PHP_EOL);
        $this->cmd->info('use App\\Http\\Controllers\\' . $nameStudly . 'Controller;' . PHP_EOL);
        $this->cmd->info("Route::resource('{$nameSnakePlural}', {$nameStudly}Controller::class)->except(['show']);" . PHP_EOL);

        // 言語ファイルの説明

        $this->cmd->info("# lang/ja/app.php追加" . PHP_EOL);
        $this->cmd->info("'{$nameSnake}' => [");
        $this->cmd->info("    'name' => '管理者',");
        $this->cmd->info("    'columns' => [");
        foreach ($columns as $row) {
            $this->cmd->info("        '{$row['snake']}' => '{$row['studly']}',");
        }
        $this->cmd->info("    ]");
        $this->cmd->info("],");
        $this->cmd->info("");

        // URIの説明

        $this->cmd->info("# 確認用URI" . PHP_EOL);
        $this->cmd->info("/{$nameSnakePlural}");

        $this->cmd->info("");
    }
}
