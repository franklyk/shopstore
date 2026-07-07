<?php

namespace App\Services\User;

use Illuminate\Database\Eloquent\Builder;

class UserFilterService
{
    public function apply(Builder $query, array $filters): Builder
    {
        return $query

            ->when(
                ! empty($filters['status']),
                fn (Builder $query) => $query->whereIn('status_id', (array) $filters['status'])
            )

            ->when(
                ! empty($filters['role']),
                fn (Builder $query) => $this->filterRoles($query, $filters['role'])
            )

            ->when(
                filled($filters['search'] ?? null),
                fn (Builder $query) => $this->filterSearch($query, $filters['search'])
            );
    }

    protected function filterRoles(Builder $query, array $roles): Builder
    {
        return $query->whereHas('roles', function (Builder $query) use ($roles) {

            $query->whereIn('id', $roles);

        });
    }

    protected function filterSearch(Builder $query, string $search): Builder
    {
        return $query->where(function (Builder $query) use ($search) {

            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");

        });
    }
}
