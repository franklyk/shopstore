<?php

namespace App\Models\Order;

use App\Enums\ShipmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    protected $fillable = [
        'order_id',
        'status',
        'tracking_code',
        'carrier',
        'shipped_at',
        'delivered_at',
        'payload',
    ];

    protected function casts(): array
    {
        return [
        'status' => ShipmentStatus::class,
        'payload' => 'array',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'returned_at' => 'datetime',
    ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
