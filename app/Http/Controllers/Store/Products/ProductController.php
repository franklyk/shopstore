<?php

namespace App\Http\Controllers\Store\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('store.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('categories');

        abort_if(! $product->is_active, 404);

        return view('store.products.show', compact('product'));
    }
}