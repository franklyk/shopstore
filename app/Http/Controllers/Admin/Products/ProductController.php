<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {

        $products = Product::with('categories', 'images')->paginate(15);

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
        $data = $request->validated();

        $categories = $data['categories'];
        unset($data['categories']);

        $stock = $data['stock'];
        unset($data['stock']);

        $image = $data['image'];
        unset($data['image']);

        return DB::transaction(function () use ($data, $categories, $stock, $image) {

            $product = Product::create($data);

            $product->categories()->attach($categories);

            $product->stocks()->create([
                'quantity' => $stock,
            ]);

            if ($image) {

                $path = $image->store(
                    'products',
                    'public'
                );

                $product->images()->create([
                    'image' => $path,
                    'is_primary' => true,
                ]);
            }

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Produto cadastrado com sucesso!!');
        });
    }

    public function show(Product $product)
    {
        // $this->authorize('view', $product);

        $product->load('categories');
        $product->load('stocks');
        $product->load('images');
        $product->load('stockMovements');

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

    public function update(UpdateProductRequest $request, Product $product,)
    {

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
