<?php

namespace Database\Seeders\ImportBDD;

use App\Models\Compte;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class compteSeeder extends Seeder
{
    public function run(): void
    {
        $old_values = DB::connection('sqlite')->select('SELECT * FROM users');
        foreach ($old_values as $old_value){
            $compte = new Compte();
            $compte->email = $old_value->email;
            $compte->password = $old_value->password;
            $compte->email_verified_at = $old_value->email_verified_at;
            $compte->created_at = $old_value->created_at;
            $compte->updated_at = $old_value->updated_at;
            $compte->save();
            $user = Profile::where('email', $old_value->email)->first();
            $user->compte()->associate($compte);
            $user->order = 1;
            $user->save();
        }
    }
}
