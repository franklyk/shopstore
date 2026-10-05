<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Status;
use App\Models\User;
use App\Services\UserFilterService;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserFilterService $filters)
    {
        $query = User::query()->with(['roles', 'status']);

        $perPage = (int) request('per_page', 15);

        if (!in_array($perPage, [10, 15, 25, 50, 100])) {
            $perPage = 15;
        }

        $users = $filters->apply($query, request()->all())
            ->paginate($perPage)
            ->withQueryString();

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        $statuses = Status::query()
            ->where('domain', 'user')
            ->orderBy('sort_order')
            ->get();

        if (request()->ajax()) {
            return view('admin.users.partials.listing', compact('users'));
        }

        return view('admin.users.index', compact(
            'users',
            'roles',
            'statuses'
        ));
    }

    public function create()
    {
        $roles = Role::query()
            ->orderBy('name')
            ->get();

        $statuses = Status::query()
            ->where('domain', 'user')
            ->orderBy('sort_order')
            ->get();

        return view('admin.users.create', compact(
            'roles',
            'statuses'
        ));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        $user->assignRole($request->role);

        return redirect()
            ->route('admin.system.users.index')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::query()
            ->orderBy('name')
            ->get();

        return view('admin.users.edit', compact(
            'user',
            'roles'
        ));
    }

    public function update(
        UpdateUserRequest $request,
        User $user
    ) {
        $user->update($request->validated());

        $user->syncRoles([$request->role]);

        return redirect()
            ->route('admin.system.users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.system.users.index')
            ->with('success', 'Usuário excluído com sucesso!');
    }
}
