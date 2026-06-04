<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Services\Stock\StockService;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Product::all() as $product) {

            app(StockService::class)
                ->increase($product, rand(10, 100));
        }
    }
}
