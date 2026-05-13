<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent')
            ->latest()
            ->paginate(15);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('categories.create', compact('categories'));
    }


    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }


    public function show(Category $category)
    {
        $category->load('parent', 'children');

        return view('categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('name')
            ->get();

        return view('categories.edit', compact('category', 'categories'));
    }

    
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Category $category)
    {
        if ($category->children()->exists()) {

            return redirect()
                ->back()
                ->with('error', 'A categoria possui subcategorias vinculadas.');
        }

        if ($category->products()->exists()) {

            return redirect()
                ->back()
                ->with('error', 'A categoria possui produtos vinculados.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}
