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
        //
        Schema::table('tables', function(Blueprint $table){
            $table->double('max_preinscription')->nullable();
            $table->boolean('open_preinscription')->default(true);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('tables', function(Blueprint $table){
            $table->dropColumn('max_preinscription');
        });Schema::table('tables', function(Blueprint $table){

            $table->dropColumn('open_preinscription');
        });
    }
};
