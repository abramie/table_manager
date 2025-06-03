<?php

namespace Database\Seeders;

use Database\Seeders\ImportBDD\DescriptionsSeeder;
use Database\Seeders\ImportBDD\importSQLite\compteSeeder;
use Database\Seeders\ImportBDD\importSQLite\CreneauSeeder;
use Database\Seeders\ImportBDD\importSQLite\EventSeeder;
use Database\Seeders\ImportBDD\importSQLite\imageSeeder;
use Database\Seeders\ImportBDD\importSQLite\InscritsSeeder;
use Database\Seeders\ImportBDD\importSQLite\JeuxSeeder;
use Database\Seeders\ImportBDD\importSQLite\RolesSeeder;
use Database\Seeders\ImportBDD\importSQLite\tableSeeder;
use Database\Seeders\ImportBDD\importSQLite\TriggerwarningsSeeder;
use Database\Seeders\ImportBDD\importSQLite\UserSeeder;
use Database\Seeders\ImportBDD\SettingsSeeder;
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
