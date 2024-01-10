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

        Schema::create('descriptions', function (Blueprint $table) {
            $table->timestamps();
            $table->string('name')->primary();
            $table->longText('description')->nullable();
        });

        DB::table('descriptions')->insert(
            array(
                'name' => 'max_tables',
                'description' => "le nombre maximum de tables possibles pour un creneau"
            )
        );

        DB::table('descriptions')->insert(
            array(
                'name' => 'nb_inscription_online_max',
                'description' => "Le nombre maximum d'inscription
            sur une table via le logiciel autorisé. -1 pour pas de limite"
            )
        );

        DB::table('descriptions')->insert(
            array(
                'name' => 'trigger_warnings',
                'description' => "Des avertissements sur le contenu d'une table"
            )
        );

        DB::table('descriptions')->insert(
            array(
                'name' => 'sans_table_toggle',
                'description' => "Ajoute une table special permettant aux joueurs d'annoncer leur presence sur le creneau sans s'inscrire à une table precise"
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
