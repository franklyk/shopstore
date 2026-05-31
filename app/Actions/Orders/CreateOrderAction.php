<?php

namespace App\Actions\Orders;

use App\Enums\PaymentStatus;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{
    public static function run(User $user, array $data = []): Order
    {
        return DB::transaction(function () use ($user, $data) {

            $cart = Cart::with('items.product')
                ->firstWhere('user_id', $user->id);

            if (! $cart || $cart->items->isEmpty()) {
                abort(400, 'Carrinho vazio.');
            }

            $subtotal = 0;

            foreach ($cart->items as $item) {
                $subtotal += (
                    $item->quantity * $item->product->price
                );
            }

            $address = Address::findOrFail(
                $data['address_id']
            );

            abort_if(
                $address->user_id !== $user->id,
                403
            );

            $order = Order::create([

                'user_id' => $user->id,

                'status' => 'pending',

                'payment_status' => PaymentStatus::PENDING,

                'subtotal' => $subtotal,

                'shipping' => 0,

                'discount' => 0,

                'total' => $subtotal,

                'customer_name' => $user->name,

                'zipcode' => $address->cep,

                'street' => $address->street,

                'number' => $address->number,

                'complement' => $address->complement,

                'district' => $address->district,

                'city' => $address->city,

                'state' => $address->state,
            ]);

            $order->payment()->create([
                'status' => PaymentStatus::PENDING,
                'amount' => $order->total,
            ]);

            foreach ($cart->items as $item) {

                $product = $item->product;

                $order->items()->create([

                    'product_id' => $product->id,

                    'name' => $product->name,

                    'slug' => $product->slug,

                    'sku' => $product->sku,

                    'price' => $product->price,

                    'quantity' => $item->quantity,

                    'subtotal' => (
                        $item->quantity * $product->price
                    ),
                ]);
            }

            $cart->items()->delete();

            return $order->load([
                'items',
                'payment',
            ]);
        });
    }
}