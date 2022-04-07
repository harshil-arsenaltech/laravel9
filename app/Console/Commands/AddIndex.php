<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:add-indexing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Indexing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $string = 'ALTER TABLE TABLE_NAME ADD INDEX `index_name` (`column_name`)';
        $indexNameVariable = 'index_name';
        $columnNameVariable = 'column_name';
        $tableNameVariable = 'TABLE_NAME';

        $sqls = '';
        $data = collect(config('sql.TABLES'));
        foreach ($data as $tableName => $indexes) {
            /**
              * @var string $tableName
            */
            $sqlWithTable = str_replace($tableNameVariable, $tableName , $string);
            foreach ($indexes as $value) {
                $newSql = str_replace($indexNameVariable, $value[1], $sqlWithTable);
                $newSql = str_replace($columnNameVariable, $value[0], $newSql);
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
