<?php

namespace App\Services\Products;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterService
{
    public function apply(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['status'] ?? null, fn ($q, $status) => $this->filterStatus($q, $status))
            ->when($filters['brand'] ?? null, fn ($q, $brand) => $this->filterBrand($q, $brand))
            ->when($filters['category'] ?? null, fn ($q, $category) => $this->filterCategory($q, $category))
            ->when($filters['supplier'] ?? null, fn ($q, $supplier) => $this->filterSupplier($q, $supplier))
            ->when($filters['collection'] ?? null, fn ($q, $collection) => $this->filterCollection($q, $collection));
    }

    private function filterStatus(Builder $query, $status): Builder
    {
        return $query->whereHas('status', function ($q) use ($status) {
            $q->whereIn('id', (array) $status);
        });
    }

    private function filterBrand(Builder $query, $brand): Builder
    {
        return $query->whereIn('brand_id', (array) $brand);
    }

    private function filterCategory(Builder $query, $category): Builder
    {
        return $query->whereHas('categories', function ($q) use ($category) {
            $q->whereIn('categories.id', (array) $category);
        });
    }

    private function filterSupplier(Builder $query, $supplier): Builder
    {
        return $query->whereHas('suppliers', function ($q) use ($supplier) {
            $q->whereIn('suppliers.id', (array) $supplier);
        });
    }

    private function filterCollection(Builder $query, $collection): Builder
    {
        return $query->whereHas('collections', function ($q) use ($collection) {
            $q->whereIn('collections.id', (array) $collection);
        });
    }
}
