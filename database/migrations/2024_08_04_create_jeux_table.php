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

        Schema::create('jeux', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->longText('description');
        });
        Schema::table('tables', function(Blueprint $table){
            $table->foreignIdFor(\App\Models\Jeu::class)->nullable()->constrained('jeux')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function(Blueprint $table){
            $table->dropColumn('jeu_id');
        });
        Schema::dropIfExists('jeux');
    }
};
