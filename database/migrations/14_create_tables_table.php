<?php

use App\Models\types\TypeInscription;
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


            $table->foreignIdFor(\App\Models\Jeu::class)->nullable()->constrained('jeux')->cascadeOnDelete();
            $table->foreignId('mj')->nullable()->constrained(table: 'profiles')->nullOnDelete();

            $table->string('nom');
            $table->longText('description')->nullable();
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
