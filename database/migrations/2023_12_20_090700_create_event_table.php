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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('nom_evenement');
            $table->string('slug')->unique();
            $table->double('max_tables')->default(8);
            $table->double('nb_inscription_online_max')->default(-1)->comment("Le nombre maximum d'inscription
            sur une table via le logiciel autorisé. -1 pour pas de limite");

            //Ajout relationel creneaux
            //$table->dateTime('date');
            $table->timestamps();
        });
        Schema::table('creneaux', function(Blueprint $table){
            $table->foreignIdFor(\App\Models\Evenement::class)->nullable()->constrained()->cascadeOnDelete();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
        Schema::table('creneaux', function(Blueprint $table){
            $table->dropForeignIdFor(\App\Models\Evenement::class);
        });
    }
};
