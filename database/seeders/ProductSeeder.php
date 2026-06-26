<?php

namespace Database\Seeders;

use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::query()->whereNotNull('parent_id')->get();

        Product::factory(100)->create()->each(function ($product) use ($categories) {

                $product->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')
                );

            });
    }
}
