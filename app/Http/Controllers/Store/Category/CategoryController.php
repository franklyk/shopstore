<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::with(['children', 'parent'])
            ->where('slug', $slug)
            ->firstOrFail();

        // categoria atual + filhos diretos
        $categoryIds = $category->children
            ->pluck('id')
            ->push($category->id);

        // produtos ligados à árvore de categorias
        $products = Product::query()
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->latest()
            ->paginate(40);

        return view('store.categories.index', compact(
            'category',
            'products'
        ));
    }
}