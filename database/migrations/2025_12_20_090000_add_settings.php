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


        DB::table('settings')->insert(
            array(
                'name' => 'nom_trigger',
                'value' => 'Triggers Warnings',
                'description' => "Nom utiliser pour les triggers warnings"
            )
        );

        DB::table('settings')->insert(
            array(
                'name' => 'autorise_mj_max_preinscription',
                'value' => 'True',
                'description' => "Definit si les MJ peuvent choisir le nombre de pré inscription (TODO)"
            )
        );

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
