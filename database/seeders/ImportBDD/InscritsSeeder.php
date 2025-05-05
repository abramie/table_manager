<?php

namespace Database\Seeders\ImportBDD;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InscritsSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM inscrits');

        foreach ($old_values as $old_value) {
            DB::connection('mysql')->table('inscrits')->insert(json_decode(json_encode($old_value), true));

        }



    }
}
