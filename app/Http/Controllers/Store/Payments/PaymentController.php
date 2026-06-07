<?php

namespace App\Http\Controllers\Store\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Payments\PaymentService;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function pay(
        Order $order,
        PaymentService $service
    ): RedirectResponse {
        $this->authorize('view', $order);

        $service->process(
            $order->payment
        );

        return redirect()
            ->route('profile.orders.show', $order);
    }
}