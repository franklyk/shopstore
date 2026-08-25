<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\Status\Status;
use App\Models\User\User;
use App\Services\User\UserFilterService;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserFilterService $filters)
    {
        $query = User::query()->with([
            'roles',
            'status',
        ]);

        $users = $filters
            ->apply($query, request()->all())
            ->paginate(15)
            ->withQueryString();

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        $statuses = Status::query()
            ->where('domain', 'user')
            ->orderBy('sort_order')
            ->get();
        return view('admin.users.index', compact(
            'users',
            'roles',
            'statuses',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();

        $statuses = Status::query()
            ->where('domain', 'user')
            ->orderBy('sort_order')
            ->get();

        return view('admin.users.create', compact(
            'roles',
            'statuses'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole($request->role);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        $user->syncRoles([$request->role]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario excluído com sucesso!');
    }
}
