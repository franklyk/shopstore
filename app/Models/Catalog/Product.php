<?php

namespace App\Models\Catalog;

Use App\Models\Stock\Stock;
Use App\Models\Stock\StockMovement;
use App\Models\Traits\HasUuid;
use App\Models\Traits\HasSlug;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{

    use HasFactory, HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'name',
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

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_primary', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->primaryImage
            ? asset('storage/'.$this->primaryImage->image)
            : null;
    }
}
