<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Services\Stock\StockService;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $stockService = app(StockService::class);

        $products = Product::all();

        foreach ($products as $product) {
            $stockService->increase(
                productId: $product->id,
                warehouseId: 1,
                quantity: 50,
                notes: 'Initial stock seed'
            );
        }
    }
}
