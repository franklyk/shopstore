<?php

namespace App\Services\Shipment;

use App\Enums\ShipmentStatus;
use App\Models\Order;
use App\Models\Shipment;
use DomainException;

class ShipmentService
{
    public function create(Order $order): Shipment
    {
        return Shipment::firstOrCreate(
            [
                'order_id' => $order->id,
            ],
            [
                'status' => ShipmentStatus::PENDING,
            ]
        );
    }

    public function process(Shipment $shipment): Shipment
    {
        if ($shipment->status !== ShipmentStatus::PENDING) {
            throw new DomainException(
                'O envio deve estar pendente antes do processamento.'
            );
        }

        $shipment->update([
            'status' => ShipmentStatus::PROCESSING,
        ]);

        return $shipment->fresh();
    }

    public function ship(
        Shipment $shipment,
        string $carrier,
        string $trackingCode,
        array $payload = []
    ): Shipment {
        if ($shipment->status !== ShipmentStatus::PROCESSING) {
            throw new DomainException(
                'O processamento do pedido deve ser concluído antes do envio.'
            );
        }

        $shipment->update([
            'status' => ShipmentStatus::SHIPPED,
            'carrier' => $carrier,
            'tracking_code' => $trackingCode,
            'shipped_at' => now(),
            'payload' => $payload,
        ]);

        return $shipment->fresh();
    }

    public function deliver(Shipment $shipment): Shipment
    {
        if ($shipment->status !== ShipmentStatus::SHIPPED) {
            throw new DomainException(
                'Shipment must be shipped before delivery.'
            );
        }

        $shipment->update([
            'status' => ShipmentStatus::DELIVERED,
            'delivered_at' => now(),
        ]);

        return $shipment->fresh();
    }

    public function markAsReturned(Shipment $shipment): Shipment
    {
        if (
            ! in_array(
                $shipment->status,
                [
                    ShipmentStatus::SHIPPED,
                    ShipmentStatus::DELIVERED,
                ],
                true
            )
        ) {
            throw new DomainException(
                'A encomenda não pode ser devolvida..'
            );
        }

        $shipment->update([
            'status' => ShipmentStatus::RETURNED,
            'returned_at' => now(),
        ]);

        return $shipment->fresh();
    }
}
