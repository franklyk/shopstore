<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::whereNotNull('parent_id')->get();

        Product::factory(100)->create()->each(function ($product) use ($categories) {

                $product->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')
                );

            });
    }
}