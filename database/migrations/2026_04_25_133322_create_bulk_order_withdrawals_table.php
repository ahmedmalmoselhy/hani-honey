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
        Schema::create('bulk_order_withdrawals', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('bulk_order_id')->constrained()->cascadeOnDelete();
            $blueprint->decimal('weight', 10, 2);
            $blueprint->timestamp('withdrawn_at');
            $blueprint->text('notes')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_order_withdrawals');
    }
};
