<?php

namespace Database\Seeders\ImportBDD;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreneauSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM creneaux');

        foreach ($old_values as $old_value) {
            DB::connection('mysql')->table('creneaux')->insert(json_decode(json_encode($old_value), true));

        }



    }
}
