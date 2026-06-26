<?php

namespace App\Http\Controllers\Admin\Collection;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCollectionRequest;
use App\Http\Requests\Admin\UpdateCollectionRequest;
use App\Models\Catalog\Collection;
use App\Models\Supplier\Supplier;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::query()
            ->with('suppliers')
            ->paginate(15);

        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        $suppliers = Supplier::query()
            ->orderBy('name')
            ->get();

        return view('admin.collections.create', compact('suppliers'));
    }

    public function store(StoreCollectionRequest $request)
    {
        $data = $request->validated();

        $collection = Collection::create([
            'name'   => $data['name'],
            'slug'   => Str::slug($data['name']),
            'year'   => $data['year'] ?? null,
            'active' => true,
        ]);

        $collection->suppliers()->sync($data['supplier_ids']);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Coleção criada com sucesso.');
    }

    public function show(Collection $collection)
    {
        $collection->load('suppliers');

        return view('admin.collections.show', compact('collection'));
    }

    public function edit(Collection $collection)
    {
        $suppliers = Supplier::query()
            ->orderBy('name')
            ->get();

        $collection->load('suppliers');

        return view('admin.collections.edit', compact('collection', 'suppliers'));
    }

    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        $data = $request->validated();

        $collection->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'year' => $data['year'] ?? null,
        ]);

        $collection->suppliers()->sync($data['supplier_ids']);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Coleção atualizada com sucesso.');
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Coleção removida com sucesso.');
    }
}
