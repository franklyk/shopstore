<?php

namespace App\Http\Controllers\Store\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Payments\PaymentService;

class PaymentController extends Controller
{
    public function pay(Order $order, PaymentService $service)
    {
        // $this->authorize('view', $order);

        $payment = $order->payment;

        $service->process($payment);

        return redirect()
            ->route('profile.orders.show', $order);
    }
}
