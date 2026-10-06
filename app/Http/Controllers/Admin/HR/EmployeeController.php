<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
    {
        $query = User::query()
            ->where('is_employee', true)
            ->with(['roles', 'status']);

        $perPage = (int) request('per_page', 15);

        if (!in_array($perPage, [10, 15, 25, 50, 100])) {
            $perPage = 15;
        }

        $employees = $query
            ->paginate($perPage)
            ->withQueryString();

        if (request()->ajax()) {
            return view(
                'admin.employees.partials.listing',
                compact('employees')
            );
        }

        return view('admin.employees.index', compact('employees'));
    }

    public function show(User $employee)
    {
        // Code...
    }
}
