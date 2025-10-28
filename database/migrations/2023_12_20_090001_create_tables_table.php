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
        //Ajout many to many avec la table d'inscription des joueurs.
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->longText('description')->default('');
            $table->longText('tw')->nullable();
            $table->float('duree')->default('4');
            $table->double('nb_joueur_min')->default('2');
            $table->double('nb_joueur_max')->default('4');
            $table->boolean('sans_table')->default('0');
            $table->dateTime('debut_table');
            $table->boolean('inscription_restrainte')->default('1');
            $table->double('max_preinscription')->default(0);
            $table->string('status')->default('published');
            $table->softDeletes();

            $table->foreignId('mj')->nullable()->constrained(table: 'profiles')->nullOnDelete();
        });



        Schema::create('inscrits',function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Profile::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Table::class)->constrained()->cascadeOnDelete();
            $table->string('status')->default('inscrit');
            $table->softDeletes();
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
