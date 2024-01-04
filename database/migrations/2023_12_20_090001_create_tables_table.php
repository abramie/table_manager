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
        //Ajout many to many avec la table d'inscription des joueurs.
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->longText('description');
            $table->longText('tw')->nullable();
            $table->float('duree')->default('4');
            $table->double('nb_joueur_min')->default('2');
            $table->double('nb_joueur_max')->default('4');


            $table->string('mj_name')->comment("A remplacer par une clef etrangere quand user done");
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
