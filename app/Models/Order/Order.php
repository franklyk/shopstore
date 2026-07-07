<?php

namespace App\Models\Order;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',

        'user_id',
        'warehouse_id',

        'status',
        'payment_status',
        'payment_method',

        'subtotal',
        'shipping',
        'discount',
        'total',

        'customer_name',

        'zipcode',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',

        'notes',
        'paid_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | BOOT (UUID)
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ROUTE MODEL BINDING
    |--------------------------------------------------------------------------
    */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function shipment(): HasOne
    {
        return $this->hasOne(Shipment::class);
    }

    public function stockReservations(): MorphMany
    {
        return $this->morphMany(
            StockReservation::class,
            'reference'
        );
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isReserved(): bool
    {
        return $this->status === 'reserved';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }
}
