<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::with('parent')
            ->latest()
            ->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->pluck('name', 'id');

        return view('admin.categories.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function show(Category $category)
    {
        $category->load('parent', 'children');

        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('name')
            ->pluck('name','id');
            // ->get();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // dd($request->validated());
        $category->update($request->validated());

        return redirect()
            ->route('admin.categories.show', $category)
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

        $category->delete($category);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}
