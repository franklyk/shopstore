<?php

namespace App\Http\Controllers\Admin\Support;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::query()
            ->where('is_employee', false)
            ->with([
                'status',
            ])
            ->paginate(15);

        return view('admin.users.customers.index', compact('customers'));
    }
}
