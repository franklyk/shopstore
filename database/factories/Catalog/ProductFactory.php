<?php

namespace Database\Factories\Catalog;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Collection;
use App\Models\Catalog\Product;
use App\Models\Status\Status;
use App\Models\Supplier\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $statusId = Status::query()
            ->where('domain', 'product')
            ->where('is_default', true)
            ->value('id');

        return [

            'uuid' => (string) Str::ulid(),

            'name' => fake('pt_BR')->words(2, true),

            'slug' => fake()->unique()->slug(),

            'sku' => strtoupper(fake()->bothify(Str::random(8))),

            'description' => fake('pt_BR')->sentence(),

            'price' => fake()->randomFloat(2, 10, 1000),

            'status_id' => $statusId,

            'brand_id' => Brand::query()->inRandomOrder()->value('id'),

        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {

            $product->collections()->attach(
                Collection::query()
                    ->inRandomOrder()
                    ->value('id')
            );

            $product->categories()->attach(
                Category::query()
                    ->inRandomOrder()
                    ->value('id')
            );

            $product->suppliers()->attach(
                Supplier::query()
                    ->inRandomOrder()
                    ->value('id')
            );
        });
    }
}
