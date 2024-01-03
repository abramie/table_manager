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
        Schema::create('settings', function (Blueprint $table) {
            $table->timestamps();
            $table->string('name')->primary();
            $table->string('value');
            $table->longText('description')->nullable();
        });

        DB::table('settings')->insert(
            array(
                'name' => 'max_tables',
                'value' => '8',
                'description' => "le nombre maximum de tables possibles pour un creneau"
            )
        );

        DB::table('settings')->insert(
            array(
                'name' => 'nb_inscription_online_max',
                'value' => '15',
                'description' => "Le nombre maximum d'inscription
            sur une table via le logiciel autorisé. -1 pour pas de limite"
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
