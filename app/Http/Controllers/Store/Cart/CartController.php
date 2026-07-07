<?php

namespace App\Http\Controllers\Store\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart\Cart;
use App\Models\Catalog\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            $cart = Cart::with('items.product')
                ->firstOrCreate([
                    'user_id' => Auth::id(),
                ]);

            return view('store.cart.index', [
                'items' => $cart->items,
                'isSession' => false,
            ]);
        }

        return view('store.cart.index', [
            'items' => session('cart', []),
            'isSession' => true,
        ]);
    }

    public function add(Product $product)
    {
        if (Auth::check()) {

            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
            ]);

            $item = $cart->items()
                ->where('product_id', $product->id)
                ->first();

            if ($item) {

                $item->increment('quantity');

            } else {

                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => 1,
                ]);
            }

        } else {

            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {

                $cart[$product->id]['quantity']++;

            } else {

                $cart[$product->id] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }

            session()->put('cart', $cart);
        }

        return $this->response();
    }

    public function remove(int|string $id)
    {
        if (Auth::check()) {

            $cart = Cart::firstWhere(
                'user_id',
                Auth::id()
            );

            if ($cart) {

                $cart->items()
                    ->where('id', $id)
                    ->delete();
            }

        } else {

            $cart = session()->get('cart', []);

            unset($cart[$id]);

            session()->put('cart', $cart);
        }

        return $this->response();
    }

    public function update(int|string $id)
    {
        $quantity = (int) request('quantity');

        if (Auth::check()) {

            $cart = Cart::firstWhere(
                'user_id',
                Auth::id()
            );

            if ($cart) {

                $item = $cart->items()
                    ->where('id', $id)
                    ->first();

                if ($item) {

                    if ($quantity > 0) {

                        $item->update([
                            'quantity' => $quantity,
                        ]);

                    } else {

                        $item->delete();
                    }
                }
            }

        } else {

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {

                if ($quantity > 0) {

                    $cart[$id]['quantity'] = $quantity;

                } else {

                    unset($cart[$id]);
                }
            }

            session()->put('cart', $cart);
        }

        return $this->response();
    }

    private function response()
    {
        if (request()->expectsJson()) {

            return response()->json([
                'success' => true,
                'cart' => session('cart', []),
            ]);
        }

        return back()->with(
            'success',
            'Carrinho atualizado.'
        );
    }
}
