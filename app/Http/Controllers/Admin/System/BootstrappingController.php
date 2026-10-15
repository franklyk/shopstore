<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\SystemInstallation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class BootstrappingController extends Controller
{
    public function create()
    {
        $installation = SystemInstallation::query()->firstOrFail();

        abort_if(
            $installation->status !== 'pending',
            403,
            'A inicialização do sistema já foi concluída.'
        );

        return view('admin.system.bootstrapping');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = DB::transaction(function () use ($data) {
            $installation = SystemInstallation::query()
                ->lockForUpdate()
                ->firstOrFail();

            if ($installation->status !== 'pending') {
                abort(403, 'A inicialização do sistema já foi concluída.');
            }

            if (User::role('owner')->exists()) {
                abort(403, 'Já existe uma conta Owner cadastrada.');
            }

            $ownerRole = Role::findByName('owner', 'web');

            $pendingStatus = Status::query()
                ->where('domain', 'user')
                ->where('slug', 'pending')
                ->firstOrFail();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'status_id' => $pendingStatus->id,
                'is_employee' => true,
            ]);

            $user->assignRole($ownerRole);

            $installation->update([
                'status' => 'initialized',
                'initialized_at' => now(),
            ]);

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect()
            ->route('verification.notice')
            ->with('success', 'Conta Owner criada. Verifique seu e-mail.');
    }
}
