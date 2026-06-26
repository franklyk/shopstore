<?php

namespace App\Models;

use App\Enums\StockReservationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StockReservation extends Model
{
    protected $fillable = [
        'uuid',
        'product_id',
        'warehouse_id',
        'quantity',
        'status',
        'expires_at',
        'reference_type',
        'reference_id',
        'user_id',
    ];

    protected $casts = [
        'status' => StockReservationStatus::class,
        'expires_at' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function confirm(): void
    {
        if ($this->status !== StockReservationStatus::ACTIVE) {
            return;
        }

        $this->update([
            'status' => StockReservationStatus::CONFIRMED,
        ]);
    }
}
