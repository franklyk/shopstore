<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function mergeSessionCart()
    {
        $sessionCart = session('cart');

        if (!$sessionCart || empty($sessionCart)) {
            return;
        }

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);

        foreach ($sessionCart as $productId => $item) {

            $existingItem = $cart->items()
                ->where('product_id', $productId)
                ->first();

            if ($existingItem) {
                // soma quantidade
                $existingItem->increment('quantity', $item['quantity']);
            } else {
                $cart->items()->create([
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] ?? 0
                ]);
            }
        }

        // limpa session
        session()->forget('cart');
    }
}