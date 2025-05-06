<?php

namespace Database\Seeders\ImportBDD;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TriggerwarningsSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM triggerwarnings');

        foreach ($old_values as $old_value) {
            DB::connection('mysql')->table('triggerwarnings')->insert(json_decode(json_encode($old_value), true));

        }

        $old_values = DB::connection('sqlite')->select('SELECT * FROM table_triggerwarning');

        foreach ($old_values as $old_value) {
            DB::connection('mysql')->table('table_triggerwarning')->insert(json_decode(json_encode($old_value), true));

        }



    }
}
