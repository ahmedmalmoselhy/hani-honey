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
        Schema::create('bulk_orders', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('customer_id')->constrained();
            $blueprint->foreignId('patch_id')->constrained();
            $blueprint->decimal('total_weight', 10, 2);
            $blueprint->decimal('total_price', 10, 2);
            $blueprint->decimal('amount_paid', 10, 2)->default(0);
            $blueprint->decimal('remaining_weight', 10, 2);
            $blueprint->enum('status', ['pending', 'paid', 'completed', 'cancelled'])->default('pending');
            $blueprint->timestamp('ordered_at');
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_orders');
    }
};
