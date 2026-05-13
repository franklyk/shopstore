<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'price',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function ($product) {

            if (empty($product->uuid)) {
                $product->uuid = (string) Str::ulid();
            }

        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}