<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Models\Payment;

class PaymentService
{
    public function __construct(
        protected FakeGateway $gateway
    ) {}

    public function process(Payment $payment): Payment
    {
        $result = $this->gateway->process($payment);

        if ($result['success']) {
            $this->markAsPaid($payment, $result['transaction_id']);
        } else {
            $this->markAsFailed($payment, $result['transaction_id']);
        }

        return $payment->fresh('order');
    }

    private function markAsPaid(Payment $payment, string $transactionId): void
    {
        $payment->update([
            'status' => 'paid',
            'transaction_id' => $transactionId,
        ]);

        $payment->order->update([
            'status' => 'paid',
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        // app(StockService::class)->decrease($payment->order);
    }

    private function markAsFailed(Payment $payment, string $transactionId): void
    {
        $payment->update([
            'status' => 'failed',
            'transaction_id' => $transactionId,
        ]);

        $payment->order->update([
            'status' => 'failed',
        ]);
    }

    public function pay(Order $order, PaymentService $service)
    {
        $payment = $order->payment;

        $service->process($payment);

        return redirect()
            ->route('profile.orders.show', $order);
    }
}
