<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Services\Cart\CartService;

class MergeCartOnLogin
{
    public function handle(Login $event): void
    {
        app(CartService::class)->mergeSessionCart();
    }
}
