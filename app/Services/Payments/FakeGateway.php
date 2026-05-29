<?php 


namespace App\Services\Payments;

use App\Models\Payment;

class FakeGateway
{
    public function process(Payment $payment): array
    {
        $success = rand(0, 1) === 1;

        return [
            'success' => $success,
            'transaction_id' => 'TX-' . strtoupper(uniqid()),
        ];
    }
}