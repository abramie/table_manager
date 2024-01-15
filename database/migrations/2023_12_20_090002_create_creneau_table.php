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
        Schema::create('creneaux', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->float('duree');
            $table->double('max_tables');
            $table->double('nb_inscription_online_max')->comment("Le nombre maximum d'inscription
            sur une table via le logiciel autorisé. -1 pour pas de limite");
            $table->boolean('sans_table')->default(0);
            $table->date('debut_creneau');
            //$table->dateTime('date');
            $table->timestamps();
        });

        Schema::table('tables', function(Blueprint $table){
            $table->foreignIdFor(\App\Models\Creneau::class)->nullable()->constrained()->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creneaux');
        Schema::table('tables', function(Blueprint $table){
            $table->dropForeignIdFor(\App\Models\Creneau::class);
        });
    }
};
