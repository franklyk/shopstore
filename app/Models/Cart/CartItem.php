<?php

namespace App\Models\Cart;

use App\Models\Cart\Cart;
use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    // 🔗 pertence a um carrinho
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // 🔗 pertence a um produto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 💰 subtotal do item
    public function subtotal()
    {
        return $this->quantity * $this->product->price;
    }
}
