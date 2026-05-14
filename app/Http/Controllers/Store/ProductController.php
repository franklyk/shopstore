<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')
            ->latest()
            ->paginate(12);

        return view('store.products.index', compact('products'));
    }
}
