<?php

namespace App\Models\Catalog;


use App\Models\Catalog\Product;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasUuid;

    protected $fillable = [
        'product_id',
        'image',

    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
