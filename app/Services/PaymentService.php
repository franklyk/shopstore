<?php

namespace App\Services\Payments;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Services\Shipment\ShipmentService;
use App\Services\Stock\StockService;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function __construct(
        protected FakeGateway $gateway,
        protected ShipmentService $shipmentService,
        protected StockService $stockService,
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

        DB::transaction(function () use (
            $payment,
            $transactionId
        ) {

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

            foreach ($order->stockReservations as $reservation) {
                $reservation->confirm();

                $this->stockService->decrease(
                    productId: $reservation->product_id,
                    warehouseId: $reservation->warehouse_id,
                    quantity: $reservation->quantity,
                    notes: 'Reservation confirmed',
                    reference: [
                        'type' => $reservation->reference_type,
                        'id' => $reservation->reference_id,
                    ]
                );
            }
            // $this->stockService->decrease($order);

            $this->shipmentService->create($order);
        });
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
