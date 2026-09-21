<?php

namespace App\Services\User;

use Illuminate\Database\Eloquent\Builder;

class UserFilterService
{
    public function apply(
        Builder $query,
        array $filters
    ): Builder {
        return $query

            ->when(
                $filters['search'] ?? null,
                fn($q, $search) => $this->filterSearch($q, $search)
            )

            ->when(
                $filters['status'] ?? null,
                fn($q, $status) => $this->filterStatus($q, $status)
            )

            ->when(
                $filters['role'] ?? null,
                fn($q, $role) => $this->filterRole($q, $role)
            )

            ->when(
                $filters['created_from'] ?? null,
                fn($q, $date) => $this->filterCreatedFrom($q, $date)
            )

            ->when(
                $filters['created_to'] ?? null,
                fn($q, $date) => $this->filterCreatedTo($q, $date)
            )

            ->when(
                $filters['sort_date'] ?? 'newest',
                fn($q, $sort) => $this->sortDate($q, $sort)
            )

            ->when(
                $filters['sort_name'] ?? 'asc',
                fn($q, $sort) => $this->sortName($q, $sort)
            );
    }

    private function filterSearch(
        Builder $query,
        string $search
    ): Builder {
        return $query->where(function ($q) use ($search) {
            $q->where(
                'name',
                'like',
                '%' . $search . '%'
            )
                ->orWhere(
                    'email',
                    'like',
                    '%' . $search . '%'
                );
        });
    }

    private function filterStatus(
        Builder $query,
        array|string|int $status
    ): Builder {
        return $query->whereIn(
            'status_id',
            (array) $status
        );
    }

    private function filterRole(
        Builder $query,
        array|string|int $role
    ): Builder {
        return $query->whereHas('roles', function ($q) use ($role) {
            $q->whereIn(
                'id',
                (array) $role
            );
        });
    }

    private function filterCreatedFrom(
        Builder $query,
        string $date
    ): Builder {
        return $query->whereDate(
            'created_at',
            '>=',
            $date
        );
    }

    private function filterCreatedTo(
        Builder $query,
        string $date
    ): Builder {
        return $query->whereDate(
            'created_at',
            '<=',
            $date
        );
    }

    private function sortDate(
        Builder $query,
        string $sort
    ): Builder {
        return $query->orderBy(
            'created_at',
            $sort === 'oldest' ? 'asc' : 'desc'
        );
    }

    private function sortName(
        Builder $query,
        string $sort
    ): Builder {
        return $query->orderBy(
            'name',
            $sort === 'desc' ? 'desc' : 'asc'
        );
    }
}
