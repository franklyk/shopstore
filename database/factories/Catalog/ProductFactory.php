<?php

namespace Database\Factories\Catalog;
use App\Models\Catalog\Product;
use App\Models\Status\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $defaultStatus = Status::query()
            ->where('domain', 'product')
            ->where('is_default', true)
            ->first();

        return [

            'uuid' => (string) Str::ulid(),

            'name' => fake('pt_BR')->words(2, true),

            'slug' => fake()->unique()->slug(),

            'sku' => strtoupper(fake()->bothify('SKU-#####')),

            'description' => fake('pt_BR')->sentence(),

            'price' => fake()->randomFloat(2, 10, 1000),

            'status_id' => $defaultStatus?->id,
        ];
    }
}
