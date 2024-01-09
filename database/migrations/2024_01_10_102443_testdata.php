<?php

use App\Models\User;
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

        if (DB::table('evenements')->count() == 0){


            $jeremy = User::create([
                'name' => "jeremy",
                'email' => "jeremyrou@hotmail.fr",
                'password' => Hash::make("test"),
            ]);
            $mad = User::create([
                'name' => "mad",
                'email' => "mad@som.fr",
                'password' => Hash::make("mad"),
            ]);

            $admin = User::create([
                'name' => "admin",
                'email' => "admin@som.fr",
                'password' => Hash::make("admin"),
            ]);

            $modo = User::create([
                'name' => "modo",
                'email' => "modo@som.fr",
                'password' => Hash::make("modo"),
            ]);

            $jeremy->assignRole('joueur','mj');
            $mad->assignRole('joueur','mj');
            $admin->assignRole('joueur','mj', 'admin');
            $modo->assignRole('joueur','mj', 'modo');

            DB::table('evenements')->insert(
                array(
                    'nom_evenement' => 'Soirée crepe',
                    'slug' => 'crepe-2024',
                )
            );
            DB::table('evenements')->insert(
                array(
                    'nom_evenement' => 'Sous l\'oeil de melusine',
                    'slug' => 'som-24',
                )
            );

            DB::table('evenements')->insert(
                array(
                    'nom_evenement' => 'Soirée barbecue',
                    'slug' => 'barbecue-24',
                )
            );

            DB::table('creneaux')->insert(
                array(
                    'nom' => 'Soirée',
                    'duree' => '5',
                    'evenement_id' => 1,
                    'max_tables' => 8,
                    'nb_inscription_online_max' => -1
                )
            );
            DB::table('creneaux')->insert(
                array(
                    'nom' => 'creneau du matin',
                    'duree' => '3',
                    'evenement_id' => 2,
                    'max_tables' => 8,
                    'nb_inscription_online_max' => -1
                )
            );

            DB::table('creneaux')->insert(
                array(
                    'nom' => 'creneau de l\'aprem',
                    'duree' => '5',
                    'evenement_id' => 2,
                    'max_tables' => 8,
                    'nb_inscription_online_max' => -1
                )
            );

            DB::table('creneaux')->insert(
                array(
                    'nom' => 'creneau du soir',
                    'duree' => '5',
                    'evenement_id' => 2,
                    'max_tables' => 8,
                    'nb_inscription_online_max' => -1
                )
            );

            DB::table('creneaux')->insert(
                array(
                    'nom' => 'creneau de nuit',
                    'duree' => '5',
                    'evenement_id' => 2,
                    'max_tables' => 8,
                    'nb_inscription_online_max' => -1
                )
            );

            DB::table('creneaux')->insert(
                array(
                    'nom' => 'Soirée',
                    'duree' => '5',
                    'evenement_id' => 3,
                    'max_tables' => 8,
                    'nb_inscription_online_max' => -1
                )
            );

            DB::table('tables')->insert(
                array(
                    'nom' => 'Le nom du scenario de pathfinder',
                    'duree' => '4',
                    'creneau_id' => 2,
                    'tw' => 'fun',
                    'nb_joueur_min' => 2,
                    'nb_joueur_max'=> 4,
                    'mj' => 1,
                    'description' => "une partie de pathfinder"
                )
            );

            DB::table('tables')->insert(
                array(
                    'nom' => 'Vous etes malade et recherché et tous le monde vous deteste',
                    'duree' => '4',
                    'creneau_id' => 2,
                    'tw' => 'racisme, dystopie',
                    'nb_joueur_min' => 2,
                    'nb_joueur_max'=> 4,
                    'mj' => 2,
                    'description' => "une partie tranquille d'extra humain"
                )
            );

            DB::table('tables')->insert(
                array(
                    'nom' => 'Sponsorisé par coca-cola',
                    'duree' => '4',
                    'creneau_id' => 2,
                    'tw' => 'fun',
                    'nb_joueur_min' => 2,
                    'nb_joueur_max'=> 4,
                    'mj' => 2,
                    'description' => "Cette partie de Marvel TV vous est apporté par coca-colatm"
                )
            );
            DB::table('tables')->insert(
                array(
                    'nom' => 'Vous etes malade et recherché et tous le monde vous deteste',
                    'duree' => '4',
                    'creneau_id' => 3,
                    'tw' => 'racisme, dystopie',
                    'nb_joueur_min' => 2,
                    'nb_joueur_max'=> 4,
                    'mj' => 2,
                    'description' => "une partie tranquille d'extra humain"
                )
            );

            DB::table('tables')->insert(
                array(
                    'nom' => 'un syndicat scélérat ',
                    'duree' => '4',
                    'creneau_id' => 3,
                    'tw' => 'fun',
                    'nb_joueur_min' => 3,
                    'nb_joueur_max'=> 5,
                    'mj' => 2,
                    'description' => "Partie de disney Vilains Victorious"
                )
            );


            DB::table('tables')->insert(
                array(
                    'nom' => 'L\'attaque des crepes ',
                    'duree' => '4',
                    'creneau_id' => 1,
                    'tw' => 'fun',
                    'nb_joueur_min' => 3,
                    'nb_joueur_max'=> 5,
                    'mj' => 2,
                    'description' => "Oh non des crepes"
                )
            );

            DB::table('tables')->insert(
                array(
                    'nom' => 'L\'attaque des saucisses ',
                    'duree' => '4',
                    'creneau_id' => 6,
                    'tw' => 'fun',
                    'nb_joueur_min' => 3,
                    'nb_joueur_max'=> 5,
                    'mj' => 2,
                    'description' => "Oh non des saucisses !"
                )
            );
            DB::table('triggerwarnings')->insert(
                array(
                    'nom' => 'mort',
                )
            );
            DB::table('triggerwarnings')->insert(
                array(
                    'nom' => 'violence',
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

            DB::table('table_tag')->insert(
                array(
                    'tag_id' => 1,
                    'table_id' => 1,
                )
            );

            DB::table('table_triggerwarning')->insert(
                array(
                    'triggerwarning_id' => 1,
                    'table_id' => 1,
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
