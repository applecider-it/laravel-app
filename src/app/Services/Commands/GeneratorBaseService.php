<?php

namespace App\Services\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * ジェネレーターのベースクラス
 */
abstract class GeneratorBaseService
{
    protected Command $cmd;

    /** 対象ファイル全て生成 */
    protected function buildAll(array $list, array $replace, bool $force, bool $dryrun, bool $display)
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

            $data = $this->convertBuildData($data);

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
    private function convertBuildData(string $data): string
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
}
