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
        //
        Schema::create('inscrits',function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Profile::class)->constrained();
            $table->foreignIdFor(\App\Models\Table::class)->constrained();
            $table->foreignId('type_inscription_id')->constrained('type_inscriptions');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
