<?php

namespace Database\Seeders;

use App\Models\Catalog\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory()
            ->count(100)
            ->create();
    }
}
