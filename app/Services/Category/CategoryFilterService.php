<?php

namespace App\Services\Category;

use Illuminate\Database\Eloquent\Builder;

class CategoryFilterService
{
    public function apply(Builder $query, array $filters): Builder
    {
        return $query

            ->when(
                !empty($filters['status']),
                fn (Builder $query) => $this->filterStatus($query, $filters['status'])
            )

            ->when(
                filled($filters['search'] ?? null),
                fn (Builder $query) => $this->filterSearch($query, $filters['search'])
            );
    }

    protected function filterStatus(Builder $query, array $status): Builder
    {
        return $query->whereIn('status_id', $status);
    }

    protected function filterSearch(Builder $query, string $search): Builder
    {
        return $query->where(function (Builder $query) use ($search) {

            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");

        });
    }
}
