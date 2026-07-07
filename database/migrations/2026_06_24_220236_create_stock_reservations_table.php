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
        Schema::create('stock_reservations', function (Blueprint $table) {
            $table->id();

            $table->ulid('uuid')->unique();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('warehouse_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('quantity');

            $table->string('status')->default('active');  // ACTIVE, CONFIRMED, CANCELLED, EXPIRED

            $table->timestamp('expires_at')->nullable();

            $table->nullableMorphs('reference');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['product_id', 'warehouse_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_reservations');
    }
};
