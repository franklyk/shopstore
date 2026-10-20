<?php

namespace App\Http\Controllers\Auth\System;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\SystemInstallation;
use App\Models\User;
use App\Notifications\EmailVerificationCodeNotification;
use App\Services\EmailVerificationService;
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

        return view('auth.bootstrapping');
    }

    public function store(
        Request $request,
        EmailVerificationService $verificationService
    ) {
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
                abort(403, 'A inicialização do sistema já foi iniciada.');
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
                'must_change_password' => false,
            ]);

            $user->assignRole($ownerRole);

            return $user;
        });

        Auth::login($user);

        $code = $verificationService->create($user);

        $user->notify(
            new EmailVerificationCodeNotification($code)
        );

        return redirect()
            ->route('verification.notice')
            ->with('success', 'Conta Owner criada. Verifique seu e-mail.');
    }
}
