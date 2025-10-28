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
                'description' => "Valeur pas default du nombre de table maximum pour un creneau, peut etre remplacer TODO"
            )
        );

        DB::table('settings')->insert(
            array(
                'name' => 'nb_inscription_online_max',
                'value' => '15',
                'description' => "Valeur pas default du nombre d'inscription en ligne maximum pour une table, peut etre remplacer TODO"
            )
        );

        DB::table('settings')->insert(
            array(
                'name' => 'trigger_warnings',
                'value' => 'true',
                'description' => "Definit si les champs trigger warnings sont gerer sur le site. true/false TODO"
            )
        );

        DB::table('settings')->insert(
            array(
                'name' => 'fermeture_inscriptions_avant_date',
                'value' => '4',
                'description' => "Definit le nombre de jour precedent un evenement par defaut avant la fermeture des inscriptions"
            )
        );
        DB::table('settings')->insert(
            array(
                'name' => 'ouverture_inscriptions_avant_date',
                'value' => '30',
                'description' => "Definit le nombre de jour precedent un evenement par defaut avant qu'il soit possible de s'inscrire sur les tables"
            )
        );
        DB::table('settings')->insert(
            array(
                'name' => 'visibiliter_avant_date',
                'value' => '30',
                'description' => "Definit le nombre de jour precedent un evenement par defaut avant qu'il soit visible dans la liste"
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
