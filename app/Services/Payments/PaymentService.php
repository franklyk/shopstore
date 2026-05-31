<?php

namespace App\Services\Payments;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Services\Shipment\ShipmentService;

class PaymentService
{
    public function __construct(
        protected FakeGateway $gateway,
        protected ShipmentService $shipmentService,
    ) {}

    public function process(Payment $payment): Payment
    {
        $result = $this->gateway->process($payment);

        if ($result['success']) {
            $this->markAsPaid(
                $payment,
                $result['transaction_id']
            );
        } else {
            $this->markAsFailed(
                $payment,
                $result['transaction_id']
            );
        }

        return $payment->fresh('order');
    }

    private function markAsPaid(
        Payment $payment,
        string $transactionId
    ): void {
        $payment->update([
            'status' => PaymentStatus::PAID->value,
            'transaction_id' => $transactionId,
        ]);

        $order = $payment->order;

        $order->update([
            'status' => 'paid',
            'payment_status' => PaymentStatus::PAID->value,
            'paid_at' => now(),
        ]);

        $this->shipmentService->create($order);

        // app(StockService::class)->decrease($order);
    }

    private function markAsFailed(
        Payment $payment,
        string $transactionId
    ): void {   
        $payment->update([
            'status' => PaymentStatus::FAILED->value,
            'transaction_id' => $transactionId,
        ]);

        $payment->order->update([
            'status' => 'failed',
            'payment_status' => PaymentStatus::FAILED->value,
        ]);
    }
}