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
            $table->double('nb_inscription_online_max')->default(50)->comment("Le nombre maximum d'inscription
            sur une table via le logiciel autorisé. -1 pour pas de limite");
            $table->longText('description')->nullable();
            $table->dateTime('date_debut');
            $table->dateTime('archivage')->nullable();
            $table->dateTime('ouverture_inscription');
            $table->dateTime('fermeture_inscription');
            $table->dateTime('affichage_evenement');
            //Ajout relationel creneaux
            //$table->dateTime('date');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('creneaux', function(Blueprint $table){
            $table->foreignIdFor(\App\Models\Evenement::class)->nullable()->constrained()->cascadeOnDelete();
            //$table->foreignIdFor(\App\Models\Evenement::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //Update sur un fresh data
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
