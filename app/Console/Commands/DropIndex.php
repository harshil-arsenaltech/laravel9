<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DropIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:drop-indexing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop Indexing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $string = 'DROP INDEX index_name ON table_name';
        $indexNameVariable = 'index_name';
        $tableNameVariable = 'table_name';

        $sqls = '';
        $data = collect(config('sql.TABLES'));
        foreach ($data as $tableName => $indexes) {
            /**
              * @var string $tableName
            */
            $sqlWithTable = str_replace($tableNameVariable, $tableName, $string);
            foreach ($indexes as $value) {
                $newSql = str_replace($indexNameVariable, $value[1], $sqlWithTable);
                if (empty($sqls)) {
                    $sqls = $newSql . ';';
                } else {
                    $sqls .= $newSql . ';';
                }
            }
        }
        logger(($sqls));
    }
}
