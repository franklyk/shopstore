<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\SystemInstallation;
use App\Models\User;
use App\Services\PermissionAssignmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserPermissionController extends Controller
{
    public function edit(
        Request $request,
        User $user,
        PermissionAssignmentService $service
    ): View {
        $this->authorizeTarget($request, $user);

        $permissions = $service->availableFor($request->user());

        $groups = $permissions->groupBy(function ($permission) {
            return str_contains($permission->name, '.')
                ? Str::before($permission->name, '.')
                : 'Outras permissões';
        });

        return view('admin.system.user-permissions', [
            'targetUser' => $user,
            'groups' => $groups,
            'assignedIds' => $user->getDirectPermissions()->modelKeys(),
            'isInitialSetup' => SystemInstallation::query()
                ->firstOrFail()
                ->status === 'super_admin_setup',
        ]);
    }

    public function update(
        Request $request,
        User $user,
        PermissionAssignmentService $service
    ): RedirectResponse {
        $this->authorizeTarget($request, $user);

        $data = $request->validate([
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => ['required', 'integer', 'distinct'],
        ]);

        $service->assign(
            $request->user(),
            $user,
            $data['permissions'] ?? []
        );

        return redirect()
            ->route('admin.system.users.permissions.edit', $user)
            ->with('success', 'Permissões salvas com sucesso.');
    }

    public function completeSetup(
        Request $request,
        User $user
    ): RedirectResponse {
        abort_unless(
            $request->user()->hasRole('owner'),
            403,
            'Somente o Owner pode concluir a configuração inicial.'
        );

        abort_unless(
            $user->is_employee && $user->hasRole('super-admin'),
            403,
            'O usuário selecionado não é o Super Admin esperado.'
        );

        DB::transaction(function () use ($user) {
            $installation = SystemInstallation::query()
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless(
                $installation->status === 'super_admin_setup',
                403,
                'A configuração inicial não está disponível.'
            );

            $superAdmin = User::query()
                ->whereKey($user->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless(
                $superAdmin->is_employee
                    && $superAdmin->hasRole('super-admin'),
                403,
                'A conta Super Admin não é válida.'
            );

            abort_if(
                $superAdmin->getDirectPermissions()->count() === 0,
                422,
                'Conceda ao menos uma permissão antes de concluir.'
            );

            $installation->update([
                'status' => 'initialized',
                'initialized_at' => now(),
            ]);
        });

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Configuração concluída. O Super Admin deverá trocar a senha no primeiro acesso.'
            );
    }

    private function authorizeTarget(Request $request, User $user): void
    {
        $installation = SystemInstallation::query()->firstOrFail();

        if ($installation->status === 'super_admin_setup') {
            abort_unless(
                $request->user()->hasRole('owner'),
                403,
                'Somente o Owner pode configurar o Super Admin.'
            );

            abort_unless(
                $user->is_employee && $user->hasRole('super-admin'),
                403,
                'Durante a configuração inicial, somente o Super Admin pode ser configurado.'
            );

            return;
        }

        abort_unless(
            $request->user()->hasRole('owner')
                || $request->user()->can('manage permissions'),
            403,
            'Você não pode gerenciar permissões.'
        );
    }
}
