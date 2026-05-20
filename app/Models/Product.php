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
        'slug',
        'description',
        'price',
        'stock',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    protected static function booted(): void
    {
        parent::boot();

        static::creating(function ($product) {

            if (empty($product->uuid)) {
                $product->uuid = (string) Str::ulid();
            }

            $product->slug = Str::slug($product->name);

        });
        static::updating(function ($product) {
            
            $product->slug = Str::slug($product->name);
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

    // public function images()
    // {
    //     return $this->hasMany(ProductImage::class);
    // }
}
