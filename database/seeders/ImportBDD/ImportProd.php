<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportProd extends Seeder
{
    public function run(): void
    {$tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        // Connect to production database
        $live_database = DB::connection('mysqlProd');
        // Get table data from production
        foreach($live_database->table('table_name')->get() as $data){
            // Save data to staging database - default db connection
            DB::table('table_name')->insert((array) $data);
        }

    }
}
