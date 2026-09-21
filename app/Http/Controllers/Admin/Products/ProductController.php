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
            'images',
            'brand',
            'status',
            'categories',
            'suppliers',
            'collections',
        ]);

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

        $product->load([
            'categories',
            'stocks',
            'images',
            'stockMovements',
            'status',
            'brand',
            'collections',
            'suppliers',
        ]);

        $brands = Brand::all();

        $collections = Collection::all();

        $suppliers = Supplier::all();

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        $statuses = Status::where('domain', 'product')->get();

        return view('admin.products.show', compact(
            'product',
            'brands',
            'collections',
            'suppliers',
            'categories',
            'statuses',
        ));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $product->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'brand_id' => $data['brand_id'],
            'status_id' => $data['status_id'],
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $path = $image->store('products', 'public');

            $productImage = $product->images->first();

            if ($productImage) {

                $productImage->update([
                    'image' => $path,
                ]);
            } else {

                $product->images()->create([
                    'image' => $path,
                ]);
            }
        }

        $product->categories()->sync($data['categories']);

        $product->collections()->sync([
            $data['collection_id'],
        ]);

        $product->suppliers()->sync([
            $data['supplier_id'],
        ]);

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
