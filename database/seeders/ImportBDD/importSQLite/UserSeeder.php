<?php

namespace Database\Seeders\ImportBDD\importSQLite;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM users');

        foreach ($old_values as $old_value) {
            //DB::connection('mysql')->table('users')->insert(json_decode(json_encode($old_value), true));
            $user = new Profile();
            $user->id = $old_value->id;
            $user->name = $old_value->name;
            $user->email = $old_value->email;
            $user->discord_tag = $old_value->discord_tag;
            $user->created_at = $old_value->created_at;
            $user->updated_at = $old_value->updated_at;
            $user->save();
        }



    }
}
