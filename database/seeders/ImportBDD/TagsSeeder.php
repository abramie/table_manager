<?php

namespace Database\Seeders\ImportBDD;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM tags');

        foreach ($old_values as $old_value) {
            DB::connection('mysql')->table('tags')->insert(json_decode(json_encode($old_value), true));

        }

        $old_values = DB::connection('sqlite')->select('SELECT * FROM taggables');

        foreach ($old_values as $old_value) {
            DB::connection('mysql')->table('taggables')->insert(json_decode(json_encode($old_value), true));

        }



    }
}
