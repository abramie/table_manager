<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('tables', function(Blueprint $table){
            //$table->foreignIdFor(\App\Models\Creneau::class)->nullable()->constrained()->cascadeOnDelete();
            $table->softDeletes();
        });
        Schema::table('evenements', function(Blueprint $table){
            //$table->foreignIdFor(\App\Models\Creneau::class)->nullable()->constrained()->cascadeOnDelete();
            $table->softDeletes();
        });
        Schema::table('creneaux', function(Blueprint $table){
            //$table->foreignIdFor(\App\Models\Creneau::class)->nullable()->constrained()->cascadeOnDelete();
            $table->softDeletes();
        });

        //

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
