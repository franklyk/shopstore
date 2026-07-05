<?php

namespace Database\Factories\Catalog;

use App\Models\Supplier\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CollectionFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Inverno', 'Verão', 'Primavera', 'Outono',
            'Natal', 'Dia das Crianças', 'Black Friday',
            'Volta às Aulas', 'Páscoa'
        ]) . ' ' . now()->year;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'year' => now()->year,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($collection) {
            $supplierIds = Supplier::inRandomOrder()
                ->take(rand(1, 3))
                ->pluck('id');

            $collection->suppliers()->attach($supplierIds);
        });
    }
}
