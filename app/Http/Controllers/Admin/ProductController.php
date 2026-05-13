<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products = Product::paginate(15);
        

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Product::class);

        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // $this->authorize('create', Product::class);
        Product::create($request->validated());

        return redirect()
        ->route('products.index')
        ->with('success', 'Produto cadastrado com sucesso!!');
    }

    
    public function show(Product $product)
    {
        // $this->authorize('view', $product);

        return view('admin.products.show', compact('product'));
    }

    
    public function edit(Product $product)
    {
        // $this->authorize('update', $product);

        return view('admin.products.edit', compact('product'));
    }

    
    public function update(UpdateProductRequest $request, Product $product)
    {
        // $this->authorize('update', $product);

        $product->update($request->validated());
        
        return redirect()
        ->route('products.index')
        ->with('success', 'Produto atualizado com sucesso!');
    }

    
    public function destroy(Product $product)
    {
        // $this->authorize('delete', $product);
            $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
}
