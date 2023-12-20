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
