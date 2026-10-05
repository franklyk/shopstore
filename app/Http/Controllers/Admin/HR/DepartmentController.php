<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::query()
            ->with(['status'])
            ->withCount('positions')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $statuses = Status::query()
            ->where('domain', 'department')
            ->orderBy('sort_order')
            ->get();

        if (request()->ajax()) {
            return view(
                'admin.departments.partials.listing',
                compact('departments')
            );
        }

        return view('admin.departments.index', compact(
            'departments',
            'statuses',
        ));
    }

    public function show(Department $department)
    {
        $department->load([
            'status',
            'positions' => function ($query) {
                $query
                    ->with('status')
                    ->withCount('users')
                    ->orderBy('name');
            },
        ]);

        return view('admin.departments.show', compact('department'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()
            ->route('admin.hr.departments.index')
            ->with('success', 'Departamento cadastrado com sucesso!');
    }

    public function update(
        UpdateDepartmentRequest $request,
        Department $department
    ) {
        $department->update($request->validated());

        return redirect()
            ->route('admin.hr.departments.show', $department)
            ->with('success', 'Departamento atualizado com sucesso!');
    }

    public function destroy(Department $department)
    {
        $hasEmployees = $department->positions()
            ->whereHas('users')
            ->exists();

        if ($hasEmployees) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Não é possível excluir este departamento porque existem funcionários vinculados às suas posições.'
                );
        }

        DB::transaction(function () use ($department) {
            $department->positions()->delete();
            $department->delete();
        });

        return redirect()
            ->route('admin.hr.departments.index')
            ->with('success', 'Departamento excluído com sucesso!');
    }
}
