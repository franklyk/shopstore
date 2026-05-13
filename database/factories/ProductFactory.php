<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'uuid' => (string) Str::ulid(),

            'name' => fake('pt_BR')->words(3, true),

            'description' => fake('pt_BR')->sentence(),

            'price' => fake()->randomFloat(2, 10, 1000),

            'stock' => fake()->numberBetween(0, 100),

        ];
    }
}