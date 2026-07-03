<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->ulid('uuid')
            ->unique();

            $table->string('name');

            $table->string('slug')
            ->unique();

            $table->string('sku')
            ->unique()
            ->nullable();

            $table->text('description')
            ->nullable();

            $table->decimal('price', 10, 2);

            $table->foreignId('status_id')
                ->constrained()
                ->restrictOnDelete();

            $table->timestamps();

            $table->softDeletes();

            $table->index('name');
            $table->index('status_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
