<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 🛒 Ver carrinho
    public function index()
    {
        $cart = Cart::with('items.product')
            ->firstOrCreate([
                'user_id' => Auth::id()
            ]);

        return view('cart.index', compact('cart'));
    }

    // ➕ Adicionar produto ao carrinho
    public function add(Product $product)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);

        $item = $cart->items()
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return back()->with('success', 'Produto adicionado ao carrinho');
    }

    // ➖ Remover item do carrinho
    public function remove(int $itemId)
    {
        
        $cart = Cart::firstWhere('user_id', Auth::id());

        if ($cart) {
            $cart->items()->where('id', $itemId)->delete();
        }

        return back()->with('success', 'Item removido do carrinho');
    }

    // 🔄 Atualizar quantidade
    public function update(int $itemId)
    {
        $cart = Cart::firstWhere('user_id', Auth::id());

        if ($cart) {
            $item = $cart->items()->where('id', $itemId)->first();

            if ($item) {
                $quantity = request('quantity');

                if ($quantity > 0) {
                    $item->update(['quantity' => $quantity]);
                } else {
                    $item->delete();
                }
            }
        }

        return back()->with('success', 'Carrinho atualizado');
    }
}