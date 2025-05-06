<?php

namespace Database\Seeders\ImportBDD;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InscritsSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM inscrits');

        foreach ($old_values as $old_value) {
            $old_value->profile_id = $old_value->user_id;
            unset($old_value->user_id);
            DB::connection('mysql')->table('inscrits')->insert(json_decode(json_encode($old_value), true));

        }



    }
}
