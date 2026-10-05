<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class ProductFilterService
{
    public function apply(Builder $query, array $filters): Builder
    {
        $this->applySorting(
            $query,
            $filters
        );

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
                $filters['brand'] ?? null,
                fn($q, $brand) => $this->filterBrand($q, $brand)
            )

            ->when(
                $filters['category'] ?? null,
                fn($q, $category) => $this->filterCategory($q, $category)
            )

            ->when(
                $filters['supplier'] ?? null,
                fn($q, $supplier) => $this->filterSupplier($q, $supplier)
            )

            ->when(
                $filters['collection'] ?? null,
                fn($q, $collection) => $this->filterCollection($q, $collection)
            )

            ->when(
                $filters['created_from'] ?? null,
                fn($q, $date) => $this->filterCreatedFrom($q, $date)
            )

            ->when(
                $filters['created_to'] ?? null,
                fn($q, $date) => $this->filterCreatedTo($q, $date)
            );
    }

    private function filterSearch(
        Builder $query,
        string $search
    ): Builder {
        return $query->where(
            'name',
            'like',
            '%' . $search . '%'
        );
    }

    private function filterStatus(
        Builder $query,
        array|string|int $status
    ): Builder {
        return $query->whereHas('status', function ($q) use ($status) {
            $q->whereIn(
                'id',
                (array) $status
            );
        });
    }

    private function filterBrand(
        Builder $query,
        array|string|int $brand
    ): Builder {
        return $query->whereIn(
            'brand_id',
            (array) $brand
        );
    }

    private function filterCategory(
        Builder $query,
        array|string|int $category
    ): Builder {
        return $query->whereHas('categories', function ($q) use ($category) {
            $q->whereIn(
                'categories.id',
                (array) $category
            );
        });
    }

    private function filterSupplier(
        Builder $query,
        array|string|int $supplier
    ): Builder {
        return $query->whereHas('suppliers', function ($q) use ($supplier) {
            $q->whereIn(
                'suppliers.id',
                (array) $supplier
            );
        });
    }

    private function filterCollection(
        Builder $query,
        array|string|int $collection
    ): Builder {
        return $query->whereHas('collections', function ($q) use ($collection) {
            $q->whereIn(
                'collections.id',
                (array) $collection
            );
        });
    }

    private function filterCreatedFrom(
        Builder $query,
        array|string|int $date
    ): Builder {
        return $query->whereDate(
            'created_at',
            '>=',
            $date
        );
    }

    private function filterCreatedTo(
        Builder $query,
        array|string|int $date
    ): Builder {
        return $query->whereDate(
            'created_at',
            '<=',
            $date
        );
    }

    private function applySorting(
        Builder $query,
        array $filters
    ): void {

        $dateSort = $filters['sort_date'] ?? 'newest';
        $nameSort = $filters['sort_name'] ?? 'asc';
        $priceSort = $filters['sort_price'] ?? 'asc';

        $query
            ->orderBy(
                'created_at',
                $dateSort === 'oldest' ? 'asc' : 'desc'
            )
            ->orderBy(
                'name',
                $nameSort === 'desc' ? 'desc' : 'asc'
            )
            ->orderBy(
                'price',
                $priceSort === 'desc' ? 'desc' : 'asc'
            );
    }
}
