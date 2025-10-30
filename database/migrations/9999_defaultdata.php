<?php

use App\Models\Compte;
use App\Models\Profile;
use App\Models\types\Typelog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (DB::table('evenements')->count() == 0 && config('app.env') == "local"){


        }elseif (config('app.env') == "production" && DB::table('comptes')->count() == 0 ){
            $admin = Compte::create([
                'email' => "admin@som.fr",
                'password' => Hash::make(config('app.admin_password')),
            ]);
            $admin->assignRole('admin');

            DB::table('triggerwarnings')->insert(
                array(
                    'nom' => 'mort',
                )
            );

            DB::table('tags')->insert(
                array(
                    'nom' => 'horreur',
                )
            );
            DB::table('tags')->insert(
                array(
                    'nom' => 'magie',
                )
            );

            TypeLog::create(['name' => 'Default', 'code' => 'DEFAULT']);

            TypeLog::create(['name' => 'Nouveau Tag', 'code' => 'TAG-ADD']);
            TypeLog::create(['name' => 'Edition Tag', 'code' => 'TAG-EDIT']);
            TypeLog::create(['name' => 'Suppression Tag', 'code' => 'TAG-DEL']);
            TypeLog::create(['name' => 'Nouveau TW', 'code' => 'TW-ADD']);
            TypeLog::create(['name' => 'Edition TW', 'code' => 'TW-EDIT']);
            TypeLog::create(['name' => 'Suppression TW', 'code' => 'TW-DEL']);
            TypeLog::create(['name' => 'Nouvelle Table', 'code' => 'TABLE-ADD']);
            TypeLog::create(['name' => 'Edition Table', 'code' => 'TABLE-EDIT']);
            TypeLog::create(['name' => 'Suppression Table', 'code' => 'TABLE-DEL']);

        }





        //

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
