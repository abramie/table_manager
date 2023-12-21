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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom')->unique();
            $table->longText('Description');
            $table->longText('tw');
            $table->float('duree');
            $table->int('nb_joueur_min');
            $table->int('nb_joueur_max');

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
