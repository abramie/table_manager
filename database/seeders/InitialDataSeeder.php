<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Compte;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\types\TypeInscription;
use App\Models\types\TypeLog;
use App\Models\types\TypeTag;
use Illuminate\Support\Facades\Hash;


class InitialDataSeeder extends Seeder
{
    public function run(): void
    {


        $admin = Compte::factory()->createProfile()->create([
            'email' => "admin@som.fr",
            'password' => Hash::make(config('app.admin_password')),
        ]);
        $admin->assignRole('admin');


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
