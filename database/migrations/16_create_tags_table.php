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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('type_tag_code');
            $table->foreign('type_tag_code')->references('code')->on('type_tags');
            $table->foreignId('created_by')->default(1)->constrained('comptes');
        });
        Schema::create('taggables',function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Tag::class)->constrained();
            $table->morphs("taggable");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('taggables');
    }
};
