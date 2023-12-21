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
