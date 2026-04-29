<?php

namespace App\Models;


use App\Models\CartItem;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
    ];

    // 🔗 Relação com itens do carrinho
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // 🔗 Relação com usuário (opcional, mas recomendado)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🧮 Total do carrinho
    public function total()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
}