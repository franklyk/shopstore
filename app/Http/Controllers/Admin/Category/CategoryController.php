<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Catalog\Category;
use App\Models\Status\Status;
use App\Services\Category\CategoryFilterService;

class CategoryController extends Controller
{
    public function index(CategoryFilterService $filters)
    {
        $query = Category::query()->with([
            'parent',
            'status',
        ]);

        $categories = $filters
            ->apply($query, request()->all())
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $statuses = Status::query()
            ->where('domain', 'category')
            ->orderBy('sort_order')
            ->get();

        return view('admin.categories.index', compact(
            'categories',
            'statuses'
        ));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->pluck('name', 'id');

        $category = new Category;

        return view('admin.categories.create', compact(
            'categories',
            'category'
        ));
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
        $categories = Category::query()
            ->where('id', '!=', $category->id)
            ->orderBy('name')
            ->pluck('name', 'id');

        return view('admin.categories.edit', compact(
            'categories',
            'category'
        ));
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
