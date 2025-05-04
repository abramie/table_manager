<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Compte;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        foreach (\App\Models\User::get() as $user){
             $compte = Compte::create($user->attributesToArray());
        }
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->change();
        });

        Schema::table('users', function(Blueprint $table){
            $table->foreignIdFor(\App\Models\Compte::class)->nullable()->constrained()->cascadeOnDelete();
            //$table->foreignIdFor(\App\Models\Evenement::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //Update sur un fresh data
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
        });
    }
};
