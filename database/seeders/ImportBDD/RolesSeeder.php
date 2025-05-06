<?php

namespace Database\Seeders\ImportBDD;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM model_has_roles');

        foreach ($old_values as $old_value) {
            $old_value->model_type = Profile::class;

            $old_value->model_id = Profile::find($old_value->model_id)->compte_id;

            DB::connection('mysql')->table('model_has_roles')->insert(json_decode(json_encode($old_value), true));

        }




    }
}
