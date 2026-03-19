<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

use App\Models\Compte;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\types\TypeInscription;
use App\Models\types\TypeLog;
use App\Models\types\TypeTag;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class InitialDataSeeder extends Seeder
{
    public function run(): void
    {

        $joueur = Role::create(['name' => 'joueur']);
        $mj = Role::create(['name' => 'mj']);
        $modo = Role::create(['name' => 'modo']);
        $admin = Role::create(['name' => 'admin']);


        $ajout_tables = Permission::create(['name' => 'ajout_tables']);
        $manage_tables_own = Permission::create(['name' => 'manage_tables_own']);
        $manage_tables_all = Permission::create(['name' => 'manage_tables_all']);

        $ajout_events = Permission::create(['name' => 'ajout_events']);
        $manage_roles = Permission::create(['name' => 'manage_roles']);
        $manage_descriptions = Permission::create(['name' => 'manage_descriptions']);

        $ajout_tags = Permission::create(['name' => 'ajout_tags']);
        $change_tags = Permission::create(['name' => 'change_tags']);
        $ajout_tws = Permission::create(['name' => 'ajout_tws']);
        $permissions_mj = [$ajout_tables,$manage_tables_own,$ajout_tags,$ajout_tws];
        $permissions_modo = [$manage_tables_all,$ajout_events,$ajout_tags,$ajout_tws, $change_tags];

        $permissions_admin = [$manage_roles,$manage_descriptions];

        $mj->syncPermissions($permissions_mj);
        $modo->syncPermissions($permissions_modo);

        $admin->syncPermissions(array_merge($permissions_modo,$permissions_admin));



        $admin = Compte::factory()->createProfile()->create([
            'email' => "admin@som.fr",
            'password' => Hash::make(config('app.admin_password')),
        ]);
        $admin->assignRole('admin');


        Settings::create(
            array(
                'name' => 'max_tables',
                'value' => '8',
                'description' => "Valeur pas default du nombre de table maximum pour un creneau, peut etre remplacer TODO"
            )
        );

        Settings::create(
            array(
                'name' => 'nb_inscription_online_max',
                'value' => '15',
                'description' => "Valeur pas default du nombre d'inscription en ligne maximum pour une table, peut etre remplacer TODO"
            )
        );

        Settings::create(
            array(
                'name' => 'trigger_warnings',
                'value' => 'true',
                'description' => "Definit si les champs trigger warnings sont gerer sur le site. true/false TODO"
            )
        );

        Settings::create(
            array(
                'name' => 'fermeture_inscriptions_avant_date',
                'value' => '4',
                'description' => "Definit le nombre de jour precedent un evenement par defaut avant la fermeture des inscriptions"
            )
        );
        Settings::create(
            array(
                'name' => 'ouverture_inscriptions_avant_date',
                'value' => '30',
                'description' => "Definit le nombre de jour precedent un evenement par defaut avant qu'il soit possible de s'inscrire sur les tables"
            )
        );
        Settings::create(
            array(
                'name' => 'visibiliter_avant_date',
                'value' => '30',
                'description' => "Definit le nombre de jour precedent un evenement par defaut avant qu'il soit visible dans la liste"
            )
        );

        Settings::create(
            array(
                'name' => 'nom_trigger',
                'value' => 'Avertissement de contenu',
                'description' => "Nom utiliser pour les triggers warnings"
            )
        );

        Settings::create(
            array(
                'name' => 'autorise_mj_max_preinscription',
                'value' => 'True',
                'description' => "Definit si les MJ peuvent choisir le nombre de pré inscription (TODO)"
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

        TypeInscription::create(['name' => 'Inscrit', 'code' => 'INS', 'bs_class' => '', 'prend_une_place' => true]);
        TypeInscription::create(['name' => 'Pré-Inscrit', 'code' => 'PRE-INS', 'bs_class' => 'fst-italic', 'prend_une_place' => true]);
        TypeInscription::create(['name' => 'Désinscrit', 'code' => 'DES-INS', 'bs_class' => 'text-decoration-line-through', 'prend_une_place' => false]);

        TypeTag::create(['name' => 'Commun', 'code' => 'BASE', 'bs_class' => 'badge bg-secondary', 'order' => 3]);
        TypeTag::create(['name' => 'TW', 'code' => 'TW', 'bs_class' => 'badge bg-danger', 'order' => 2]);
        TypeTag::create(['name' => 'Type', 'code' => 'TYPE', 'bs_class' => 'badge bg-primary', 'order' => 1]);

        Tag::create(['name' => 'Campagne', "type_tag_code" => 'TYPE', 'order' => 3, 'created_by' => $admin->id]);
        Tag::create(['name' => 'One-shot', "type_tag_code" => 'TYPE', 'order' => 1, 'created_by' => $admin->id]);
        Tag::create(['name' => 'Atelier', "type_tag_code" => 'TYPE', 'order' => 4, 'created_by' => $admin->id]);
        Tag::create(['name' => 'Multi-scenar', "type_tag_code" => 'TYPE', 'order' => 2, 'created_by' => $admin->id]);


        \App\Models\StatusTable::create(['name' => 'Public', 'code' => 'PUB']);








    }
}
