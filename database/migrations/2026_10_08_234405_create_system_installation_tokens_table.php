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
        Schema::create('system_installation_tokens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('system_installation_id')
                ->constrained('system_installations')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('token_hash')->unique();
            $table->timestamp('revoked_at')->nullable();
            $table->timestamp('consumed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_installation_tokens');
    }
};
