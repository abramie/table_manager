<?php

namespace Database\Seeders\ImportBDD\importSQLite;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tableSeeder extends Seeder
{
    public function run(): void
    {
        $old_tables = DB::connection('sqlite')->select('SELECT * FROM tables');

        foreach ($old_tables as $old_table) {
            DB::connection('mysql')->table('tables')->insert(json_decode(json_encode($old_table), true));
        }



    }
}
