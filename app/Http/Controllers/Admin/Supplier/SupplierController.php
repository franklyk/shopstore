<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Support\Str;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::query()->paginate(15);

        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        $data = $request->validated();

        Supplier::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'active' => true,
        ]);

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Fornecedor criado com sucesso.');
    }


    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show', compact('supplier'));
    }


    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $data = $request->validated();

        $supplier->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);

        return redirect()
            ->route('admin.suppliers.show', $supplier)
            ->with('success', 'Fornecedor atualizado com sucesso.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Fornecedor removido com sucesso.');
    }
}
