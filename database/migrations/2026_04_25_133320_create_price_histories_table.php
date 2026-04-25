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
        Schema::create('price_histories', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('patch_id')->constrained()->cascadeOnDelete();
            $blueprint->decimal('price_per_kg', 10, 2);
            $blueprint->timestamp('changed_at');
            $blueprint->string('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_histories');
    }
};
