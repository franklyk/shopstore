<?php

namespace App\Models\Stock;

use App\Enums\StockReceiptStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockReceipt extends Model
{
    protected $fillable = [
        'uuid',
        'warehouse_id',
        'status',
        'notes',
        'user_id',
    ];

    protected $casts = [
        'status' => StockReceiptStatus::class,
    ];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(StockReceiptItem::class);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
