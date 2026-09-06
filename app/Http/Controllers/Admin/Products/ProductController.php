<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Collection;
use App\Models\Catalog\Product;
use App\Models\Status\Status;
use App\Models\Supplier\Supplier;
use App\Services\Products\ProductFilterService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index(ProductFilterService $filters)
    {
        $query = Product::with([
            'brand',
            'status',
            'categories',
            'suppliers',
            'collections',
        ])
            ->orderByDesc('created_at');

        $perPage = (int) request('per_page', 15);

        if (!in_array($perPage, [10, 15, 25, 50, 100])) {

            $perPage = 15;
        }

        $products = $filters->apply($query, request()->all())
            ->paginate($perPage)
            ->withQueryString();

        $statuses = Status::query()
            ->where('domain', 'product')
            ->orderBy('sort_order')
            ->get();

        $suppliers = Supplier::query()
            ->orderBy('name')
            ->get();

        $brands = Brand::query()
            ->orderBy('name')
            ->get();

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        $collections = Collection::query()
            ->orderByDesc('year')
            ->orderBy('name')
            ->get();

        if (request()->ajax()) {

            return view(
                'admin.products.partials.listing',
                compact('products')
            );
        }

        return view('admin.products.index', compact(
            'products',
            'statuses',
            'suppliers',
            'brands',
            'categories',
            'collections'
        ));
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

        $collection = $data['collection_id'];
        unset($data['collection_id']);

        $image = $data['image'] ?? null;
        unset($data['image']);

        $supplier = $data['supplier_id'];
        unset($data['supplier_id']);

        return DB::transaction(function () use (
            $data,
            $categories,
            $collection,
            $image,
            $supplier
        ) {

            $product = Product::create($data);

            $product->categories()->attach($categories);

            $product->collections()->attach($collection);

            $product->suppliers()->attach($supplier);

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

            return response()->json([
                'success' => true,
                'message' => 'Produto cadastrado com sucesso!!',
            ]);
        });
    }

    public function show(Product $product)
    {
        // $this->authorize('view', $product);

        $product->load('categories');
        $product->load('stocks');
        $product->load('images');
        $product->load('stockMovements');
        $product->load('status');

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

        $product->update($request->validated());

        $product->categories()->sync($request->categories);

        return redirect()
            ->route('admin.products.show', $product)
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
