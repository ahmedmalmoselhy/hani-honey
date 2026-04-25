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
        Schema::create('internal_usages', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('patch_id')->constrained();
            $blueprint->decimal('weight', 10, 2);
            $blueprint->enum('type', ['gift', 'home_usage', 'loss']);
            $blueprint->string('recipient')->nullable();
            $blueprint->text('notes')->nullable();
            $blueprint->timestamp('occurred_at');
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_usages');
    }
};
