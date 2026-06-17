<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {

        $products = Product::with('categories', 'stocks')->paginate(40);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        // $this->authorize('create', Product::class);

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        // $this->authorize('create', Product::class);

        $product = Product::create($request->validated());

        $product->categories()->attach($request->categories);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produto cadastrado com sucesso!!');
    }

    public function show(Product $product)
    {
        // $this->authorize('view', $product);

        $product->load('categories');
        $product->load('stocks');

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // $this->authorize('update', $product);

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        $product->load('categories');
        $product->load('stocks');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        // $this->authorize('update', $product);

        $product->update($request->validated());

        $product->categories()->sync($request->categories);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        // $this->authorize('delete', $product);

        $product->categories()->detach();

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
}
