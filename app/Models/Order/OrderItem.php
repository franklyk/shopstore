<?php

namespace App\Models\Order;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class OrderItem extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [

        'order_id',
        'product_id',

        'name',
        'sku',

        'price',
        'quantity',
        'subtotal',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | STOCK INTEGRATION (CRÍTICO ERP)
    |--------------------------------------------------------------------------
    |
    | Permite rastrear reservas de estoque por item do pedido.
    |
    */
    public function stockReservations(): MorphMany
    {
        return $this->morphMany(
            StockReservation::class,
            'reference'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function getTotalAttribute(): float
    {
        return (float) $this->price * (int) $this->quantity;
    }
}
