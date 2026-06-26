<?php

namespace App\Policies;

use App\Models\Order\Order;
use App\Models\User\User;

class OrderPolicy
{
    public function view(User $user, Order $order): bool
    {
        return $user->hasRole('super-admin')
            || $user->hasRole('admin')
            || $order->user_id === $user->id;
    }
}
