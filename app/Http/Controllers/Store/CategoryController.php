<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->with(['children', 'parent'])
            ->firstOrFail();

        // pega IDs da categoria + filhos (base simples de catálogo)
        $categoryIds = collect([$category->id])
            ->merge($category->children->pluck('id'))
            ->toArray();

        // produtos (ajustar depois quando tiver pivot N:N se necessário)
        $products = $category->products()
            ->paginate(12);

        return view('store.categories.show', compact(
            'category',
            'products'
        ));
    }
}