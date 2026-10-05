<?php

namespace App\Models;


use App\Models\Product;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
