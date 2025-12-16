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
        Schema::table('logs', function(Blueprint $table){
            $table->foreignIdFor(\App\Models\Profile::class)->nullable()->constrained()->cascadeOnDelete();
            $table->nullableMorphs('loggable');
            $table->foreignIdFor(\App\Models\types\TypeLog::class)->nullable()->constrained()->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
