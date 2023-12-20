<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::table('evenements')->insert(
            array(
                'nom_evenement' => 'event test 1',
                'slug' => 'test-1',
            )
        );
        DB::table('evenements')->insert(
            array(
                'nom_evenement' => 'event test 2',
                'slug' => 'test-2',
            )
        );

        DB::table('creneaux')->insert(
            array(
                'nom' => 'premier creneau',
                'duree' => '2',
                'evenement_id' => 1,
            )
        );
        DB::table('creneaux')->insert(
            array(
                'nom' => 'second creneau',
                'duree' => '2',
                'evenement_id' => 1,
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
