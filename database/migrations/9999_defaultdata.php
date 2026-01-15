<?php

use App\Models\Compte;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\types\TypeInscription;
use App\Models\types\TypeLog;
use App\Models\types\TypeTag;
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

        TypeInscription::create(['name' => 'Inscrit', 'code' => 'INS', 'bs_class' => '', 'prend_une_place' => true]);
        TypeInscription::create(['name' => 'Pré-Inscrit', 'code' => 'PRE-INS', 'bs_class' => 'fst-italic', 'prend_une_place' => true]);
        TypeInscription::create(['name' => 'Désinscrit', 'code' => 'DES-INS', 'bs_class' => 'text-decoration-line-through', 'prend_une_place' => false]);

        TypeTag::create(['name' => 'Commun', 'code' => 'BASE', 'bs_class' => 'badge bg-secondary', 'order' => 3]);
        TypeTag::create(['name' => 'TW', 'code' => 'TW', 'bs_class' => 'badge bg-danger', 'order' => 2]);
        TypeTag::create(['name' => 'Type', 'code' => 'TYPE', 'bs_class' => 'badge bg-primary', 'order' => 1]);




        \App\Models\StatusTable::create(['name' => 'Public', 'code' => 'PUB']);

        if (DB::table('evenements')->count() == 0 && config('app.env') == "local"){


        }elseif (config('app.env') == "production" && DB::table('comptes')->count() == 0 ){
            $admin = Compte::create([
                'email' => "admin@som.fr",
                'password' => Hash::make(config('app.admin_password')),
            ]);
            $admin->assignRole('admin');

            DB::table('triggerwarnings')->insert(
                array(
                    'name' => 'mort',
                )
            );

            DB::table('tags')->insert(
                array(
                    'name' => 'horreur',
                )
            );
            DB::table('tags')->insert(
                array(
                    'name' => 'magie',
                )
            );



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
