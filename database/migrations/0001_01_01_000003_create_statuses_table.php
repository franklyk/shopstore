<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {

            $table->id();

            // product, category, collection, user...
            $table->string('domain', 50);

            // Nome exibido
            $table->string('name', 100);

            // Identificador interno
            $table->string('slug', 100);

            // Cor do badge
            $table->string('color', 30)->nullable();

            // Ordem de exibição
            $table->unsignedSmallInteger('sort_order')->default(0);

            // Status padrão daquele tipo
            $table->boolean('is_default')->default(false);

            // Permite desativar um status sem excluí-lo
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->unique(['domain', 'slug']);
            $table->index('domain');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
