<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use App\Models\Traits\HasSlug;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory, HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name',
        'is_active',
    ];

    protected static function booted(): void
    {
        static::creating(function ($category) {

            if (empty($category->uuid)) {
                $category->uuid = (string) Str::ulid();
            }

        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function allProducts()
    {
        $categoryIds = $this->children->pluck('id')->push($this->id);

        return Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        });
    }
}
