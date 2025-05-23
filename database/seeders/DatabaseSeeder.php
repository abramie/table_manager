<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Creneau;
use App\Models\Evenement;
use App\Models\Table;
use App\Models\Tag;
use App\Models\Triggerwarning;
use App\Models\Profile;
use Database\Factories\CreneauFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Profile::factory(10)->create();

        // \App\Models\Profile::factory()->create([
        //     'name' => 'Test Profile',
        //     'email' => 'test@example.com',
        // ]);

        if(Profile::where('email' ,'=', "admin@som.fr")->doesntExist()){
            $admin = Profile::create([
                'name' => "admin",
                'email' => "admin@som.fr",
                'password' => Hash::make('admin'),
            ]);
            $admin->assignRole('admin');
        }

        if(Profile::where('email' ,'=', "test@example.com")->doesntExist()) {
            $test_user = \App\Models\Profile::factory()->create([
                'name' => 'Test Profile',
                'email' => 'test@example.com',
                'password' => Hash::make('test'),
            ]);
        }


        if(Profile::where('email' ,'=', "modo@som.fr")->doesntExist()) {
            $modo = Profile::create([
                'name' => "modo",
                'email' => "modo@som.fr",
                'password' => Hash::make("modo"),
            ]);
        }

        $jeremy = Profile::create([
            'name' => "jeremy",
            'email' => "jeremyrou@som.fr",
            'password' => Hash::make("test"),
        ]);
        $mad = Profile::create([
            'name' => "mad",
            'email' => "mad@som.fr",
            'password' => Hash::make("mad"),
        ]);


        $test_user->assignRole('joueur','mj');
        $jeremy->assignRole('joueur','mj');
        $mad->assignRole('joueur','mj');

        $modo->assignRole('joueur','mj', 'modo');

        $Random_user = Profile::factory(50)->create();

        $Random_user->each(function (Profile $item, int $key) {
            // ...
            $item->assignRole('joueur');
        });
        $Random_user_mj = Profile::factory(15)->create();

        $Random_user_mj->each(function (Profile $item, int $key) {
            // ...
            $item->assignRole('joueur','mj');
        });

        /*
                DB::table('evenements')->insert(
                    array(
                        'nom_evenement' => 'Soirée crepe',
                        'slug' => 'crepe-2024',
                        'date_debut' => \Carbon\Carbon::create(2024,01,19,21),
                        'ouverture_inscription'=> \Carbon\Carbon::create(2024,01,01,21),
                        'affichage_evenement' => \Carbon\Carbon::create(2024,01,01,21),
                        'fermeture_inscription'=> \Carbon\Carbon::create(2024,01,19,21),
                        'description' => "La soirée crêpe annuel de la guilde ",
                    )
                );*/
        DB::table('evenements')->insert(
            array(
                'nom_evenement' => 'Sous l\'oeil de melusine',
                'slug' => 'som-24',
                'date_debut' => \Carbon\Carbon::create(2025,05,11,10),
                'ouverture_inscription'=> \Carbon\Carbon::create(2025,01,01,21),
                'affichage_evenement' => \Carbon\Carbon::create(2025,01,01,21),
                'fermeture_inscription'=> \Carbon\Carbon::create(2025,05,11,10),
                'description' => "La convention annuelle de l'association La guilde, dans la salle du foyer du porteau à Poitiers. Buvette (options vegans), entrée gratuite, ouverte à tous. ",
            )
        );
        /*
                DB::table('evenements')->insert(
                    array(
                        'nom_evenement' => 'Soirée barbecue',
                        'slug' => 'barbecue-24',
                        'date_debut' => \Carbon\Carbon::create(2024,06,19,21),
                        'ouverture_inscription'=> \Carbon\Carbon::create(2024,05,19,21),
                        'affichage_evenement' => \Carbon\Carbon::create(2024,05,19,20),
                        'fermeture_inscription'=> \Carbon\Carbon::create(2024,06,19,21),
                    )
                );

                DB::table('creneaux')->insert(
                    array(
                        'nom' => 'Soirée',
                        'duree' => '5',
                        'evenement_id' => 1,
                        'max_tables' => 8,
                        'nb_inscription_online_max' => 15,
                        'debut_creneau' => \Carbon\Carbon::create(2024,01,19,21)
                    )
                );*/
        DB::table('creneaux')->insert(
            array(
                'nom' => 'creneau du matin',
                'duree' => '3',
                'evenement_id' => 1,
                'max_tables' => 8,
                'nb_inscription_online_max' => 2,
                'debut_creneau' => \Carbon\Carbon::create(2025,05,11,10),
            )
        );

        DB::table('creneaux')->insert(
            array(
                'nom' => 'creneau de l\'aprem',
                'duree' => '5',
                'evenement_id' => 1,
                'max_tables' => 8,
                'nb_inscription_online_max' => 2,
                'debut_creneau' => \Carbon\Carbon::create(2025,05,11,14),
            )
        );

        DB::table('creneaux')->insert(
            array(
                'nom' => 'creneau du soir',
                'duree' => '5',
                'evenement_id' => 1,
                'max_tables' => 8,
                'nb_inscription_online_max' => 2,
                'debut_creneau' => \Carbon\Carbon::create(2025,05,11,21),
            )
        );

        DB::table('creneaux')->insert(
            array(
                'nom' => 'creneau de nuit',
                'duree' => '5',
                'evenement_id' => 1,
                'max_tables' => 8,
                'nb_inscription_online_max' => 2,
                'debut_creneau' => \Carbon\Carbon::create(2025,05,12,03),
            )
        );
        /*
                DB::table('creneaux')->insert(
                    array(
                        'nom' => 'Soirée',
                        'duree' => '5',
                        'evenement_id' => 3,
                        'max_tables' => 8,
                        'nb_inscription_online_max' => 15,
                        'debut_creneau' => \Carbon\Carbon::create(2024,06,19,21)
                    )
                );
        */
        DB::table('tables')->insert(
            array(
                'nom' => 'Le nom du scenario de pathfinder',
                'duree' => '4',
                'creneau_id' => 2,
                'tw' => 'fun',
                'nb_joueur_min' => 2,
                'nb_joueur_max'=> 4,
                'mj' => 1,
                'description' => "une partie de pathfinder",
                'debut_table' => \Carbon\Carbon::create(2025,05,11,10)
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
                'description' => "une partie tranquille d'extra humain",
                'debut_table' => \Carbon\Carbon::create(2025,05,11,10)
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
                'description' => "Cette partie de Marvel TV vous est apporté par coca-colatm",
                'debut_table' => \Carbon\Carbon::create(2025,05,11,10)
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
                'description' => "une partie tranquille d'extra humain",
                'debut_table' => \Carbon\Carbon::create(2025,05,11,14),
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
                'description' => "Partie de disney Vilains Victorious",
                'debut_table' => \Carbon\Carbon::create(2025,05,11,14),
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
                'description' => "Oh non des crepes",
                'debut_table' => \Carbon\Carbon::create(2025,01,19,21)
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
                'description' => "Oh non des saucisses !",
                'debut_table' => \Carbon\Carbon::create(2025,06,19,21)
            )
        );


        $events = Collection::make();
        $events->push(  Evenement::factory(1)
            ->create());

        $test = (Evenement::factory(3)
            ->afficher()
            ->inscriptions_ouvertes()
            ->create());
        $events=$events->concat($test);

        $creneaux = Creneau::factory(7)->recycle($events)->create();


        $table = Table::factory(12)->recycle($creneaux)->recycle($Random_user_mj)->create();


        $tags = Tag::factory(15)->create();
        $triggerwarning = Triggerwarning::factory(15)->create();

        $table->each(function (Table $item, int $key, ) use ($tags,$triggerwarning) {
            // ...
            $item->tags()->sync($tags->random(rand(0,15)));
            $item->triggerwarnings()->sync($triggerwarning->random(rand(0,15)));
        });
/*
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

        DB::table('table_triggerwarning')->insert(
            array(
                'triggerwarning_id' => 1,
                'table_id' => 1,
            )
        );
*/
    }
}
