<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;

class PermissionAssignmentService
{
    public function assign(
        User $manager,
        User $target,
        array $permissionIds
    ): void {
        $isOwner = $manager->hasRole('owner');

        if (
            !$isOwner
            && !$manager->can('manage permissions')
        ) {
            abort(403, 'Você não pode gerenciar permissões.');
        }

        $permissions = Permission::query()
            ->whereIn('id', $permissionIds)
            ->get();

        if ($permissions->count() !== count(array_unique($permissionIds))) {
            throw ValidationException::withMessages([
                'permissions' => 'Uma ou mais permissões são inválidas.',
            ]);
        }

        if (!$isOwner) {
            $allowedIds = $manager->getAllPermissions()
                ->modelKeys();

            if ($permissions->contains(
                fn (Permission $permission) =>
                    !in_array($permission->id, $allowedIds, true)
            )) {
                abort(
                    403,
                    'Você não pode conceder permissões que não possui.'
                );
            }
        }

        if ($target->hasRole('owner')) {
            abort(403, 'As permissões do Owner não podem ser alteradas.');
        }

        DB::transaction(function () use ($target, $permissions) {
            $target->syncPermissions($permissions);
        });
    }

    public function availableFor(User $manager): Collection
    {
        if ($manager->hasRole('owner')) {
            return Permission::query()
                ->orderBy('name')
                ->get();
        }

        return $manager->getAllPermissions()
            ->sortBy('name')
            ->values();
    }
}
