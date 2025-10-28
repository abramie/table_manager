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
        Schema::create('triggerwarnings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom')->unique();
        });

        //Create many to many relation between table and triggerwarning
        Schema::create('table_triggerwarning',function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Triggerwarning::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Table::class)->constrained()->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_triggerwarnings');
        Schema::dropIfExists('triggerwarnings');

    }
};
