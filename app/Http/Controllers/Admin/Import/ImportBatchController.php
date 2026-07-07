<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Import\StoreImportBatchRequest;
use App\Models\Import\ImportBatch;
use Illuminate\Support\Facades\Storage;

class ImportBatchController extends Controller
{
    public function index()
    {
        $imports = ImportBatch::latest()->paginate(15);

        return view('admin.imports.index', compact('imports'));
    }

    public function create()
    {
        return view('admin.imports.create');
    }

    public function store(StoreImportBatchRequest $request)
    {
        $file = $request->file('file');

        $path = $file->store('imports/pdfs', 'public');

        ImportBatch::create([
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'status' => 'uploaded',
        ]);

        return redirect()
            ->route('admin.imports.index')
            ->with('success', 'PDF enviado com sucesso.');
    }

    public function show(ImportBatch $importBatch)
    {
        return view('admin.imports.show', [
            'import' => $importBatch,
        ]);
    }

    public function pdf(ImportBatch $importBatch)
    {
        return response()->file(
            Storage::disk('public')->path($importBatch->file_path)
        );
    }

    public function destroy(ImportBatch $importBatch)
    {
        Storage::disk('public')->delete($importBatch->file_path);

        $importBatch->delete();

        return redirect()
            ->route('admin.imports.index')
            ->with('success', 'Importação removida com sucesso.');
    }
}
