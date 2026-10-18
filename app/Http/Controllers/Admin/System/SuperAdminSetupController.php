<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\SystemInstallation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class SuperAdminSetupController extends Controller
{
    public function create(): View|RedirectResponse
    {
        $installation = SystemInstallation::query()->firstOrFail();

        if ($installation->status !== 'super_admin_setup') {
            return redirect()->route('login');
        }

        return view('admin.system.super-admin-setup');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(12),
            ],
        ]);

        DB::transaction(function () use ($data) {
            $installation = SystemInstallation::query()
                ->lockForUpdate()
                ->firstOrFail();

            if ($installation->status !== 'super_admin_setup') {
                abort(403, 'A configuração do Super Admin não está disponível.');
            }

            if (User::role('super-admin')->exists()) {
                abort(403, 'Já existe uma conta Super Admin cadastrada.');
            }

            $role = Role::findByName('super-admin', 'web');

            $activeStatus = Status::query()
                ->where('domain', 'user')
                ->where('slug', 'active')
                ->firstOrFail();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'status_id' => $activeStatus->id,
                'is_employee' => true,
                'must_change_password' => true,
            ]);

            $user->assignRole($role);

            $installation->update([
                'status' => 'initialized',
                'initialized_at' => now(),
            ]);
        });

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Super Admin cadastrado. A conta deverá alterar a senha no primeiro acesso.'
            );
    }
}
