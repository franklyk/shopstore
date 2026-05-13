<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'parent_id',
        'name',
        'slug',
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
}