<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
        'is_primary',
    ];



    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
