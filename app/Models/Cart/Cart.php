<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function total()
    {
        return $this->items()
            ->with('product')
            ->get()
            ->sum(fn ($item) => $item->quantity * $item->product->price);
    }

    public function getTotalAttribute()
    {
        return $this->items()
            ->with('product')
            ->get()
            ->sum(fn ($item) => $item->quantity * $item->product->price);
    }
}
