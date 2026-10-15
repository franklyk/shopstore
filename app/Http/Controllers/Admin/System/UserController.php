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

        if (! in_array($perPage, [10, 15, 25, 50, 100], true)) {
            $perPage = 15;
        }

        $users = $filters->apply($query, request()->all())
            ->paginate($perPage)
            ->withQueryString();

        $roles = $this->availableRoles();

        $statuses = Status::query()
            ->where('domain', 'user')
            ->orderBy('sort_order')
            ->get();

        if (request()->ajax()) {
            return view('admin.system.users.partials.listing', compact('users'));
        }

        return view('admin.system.users.index', compact(
            'users',
            'roles',
            'statuses'
        ));
    }

    public function create()
    {
        $roles = $this->availableRoles();

        $statuses = Status::query()
            ->where('domain', 'user')
            ->orderBy('sort_order')
            ->get();

        return view('admin.system.users.create', compact(
            'roles',
            'statuses'
        ));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $role = $data['role'];

        $this->authorizeRoleAssignment($role);

        unset($data['role']);

        $user = User::create($data);

        $user->assignRole($role);

        return redirect()
            ->route('admin.system.users.index')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function show(User $user)
    {
        return view('admin.system.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorizeUserManagement($user);

        $roles = $this->availableRoles();

        $statuses = Status::query()
            ->where('domain', 'user')
            ->orderBy('sort_order')
            ->get();

        return view('admin.system.users.edit', compact(
            'user',
            'roles',
            'statuses'
        ));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorizeUserManagement($user);

        $data = $request->validated();

        $role = $data['role'];

        $this->authorizeRoleAssignment($role);

        unset($data['role']);

        $user->update($data);

        $user->syncRoles([$role]);

        return redirect()
            ->route('admin.system.users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $this->authorizeUserManagement($user);

        $user->delete();

        return redirect()
            ->route('admin.system.users.index')
            ->with('success', 'Usuário excluído com sucesso!');
    }

    /**
     * Return roles available to the authenticated user.
     */
    private function availableRoles()
    {
        $query = Role::query()->orderBy('name');

        if (! auth()->user()->hasRole('owner')) {
            $query->whereNotIn('name', ['owner', 'super-admin']);
        }

        return $query->get();
    }

    private function authorizeUserManagement(User $user): void
    {
        $authUser = auth()->user();

        abort_unless($authUser, 403);

        if ($authUser->hasRole('owner')) {
            return;
        }

        abort_if(
            $user->hasAnyRole(['owner', 'super-admin']),
            403,
            'Você não tem autorização para gerenciar esta conta.'
        );
    }

    /**
     * Only the Owner can assign or remove privileged roles.
     */
    private function authorizeRoleAssignment(string $role): void
    {
        if (auth()->user()->hasRole('owner')) {
            return;
        }

        abort_if(
            in_array($role, ['owner', 'super-admin'], true),
            403,
            'Somente o Owner pode atribuir esta função.'
        );
    }
}
