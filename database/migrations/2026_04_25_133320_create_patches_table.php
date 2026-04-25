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
        Schema::create('patches', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->integer('year');
            $blueprint->integer('patch_number');
            $blueprint->decimal('total_weight', 10, 2);
            $blueprint->decimal('remaining_weight', 10, 2);
            $blueprint->decimal('current_price_per_kg', 10, 2);
            $blueprint->enum('status', ['active', 'depleted'])->default('active');
            $blueprint->text('notes')->nullable();
            $blueprint->timestamps();

            $blueprint->unique(['year', 'patch_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patches');
    }
};
