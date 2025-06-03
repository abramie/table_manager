<?php

namespace Database\Seeders\ImportBDD\importSQLite;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class imageSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM images');

        foreach ($old_values as $old_value) {
            DB::connection('mysql')->table('images')->insert(json_decode(json_encode($old_value), true));

        }



    }
}
