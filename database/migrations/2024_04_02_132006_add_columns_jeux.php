<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jeux', function (Blueprint $table) {
            $table->string('nom');
            $table->longText('description');

        });

        Schema::table('tables', function(Blueprint $table){
            $table->foreignIdFor(\App\Models\Jeu::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('jeux', function (Blueprint $table) {
            //
            $table->dropColumn('nom');
            $table->dropColumn('description');
        });
    }
};
