<?php

namespace Database\Seeders\ImportBDD;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JeuxSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM jeux');

        foreach ($old_values as $old_value) {
            DB::connection('mysql')->table('jeux')->insert(json_decode(json_encode($old_value), true));

        }



    }
}
