<?php

namespace Database\Seeders;

use Database\Seeders\ImportBDD\compteSeeder;
use Database\Seeders\ImportBDD\CreneauSeeder;
use Database\Seeders\ImportBDD\DescriptionsSeeder;
use Database\Seeders\ImportBDD\EventSeeder;
use Database\Seeders\ImportBDD\imageSeeder;
use Database\Seeders\ImportBDD\InscritsSeeder;
use Database\Seeders\ImportBDD\JeuxSeeder;
use Database\Seeders\ImportBDD\RolesSeeder;
use Database\Seeders\ImportBDD\SettingsSeeder;
use Database\Seeders\ImportBDD\tableSeeder;
use Database\Seeders\ImportBDD\TriggerwarningsSeeder;
use Database\Seeders\ImportBDD\UserSeeder;
use Illuminate\Database\Seeder;

class ImportSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CompteSeeder::class,
            RolesSeeder::class,
            imageSeeder::class,
            jeuxSeeder::class,
            EventSeeder::class,
            CreneauSeeder::class,
            tableSeeder::class,
            InscritsSeeder::class,
            TriggerwarningsSeeder::class,
        ]);
    }
}
