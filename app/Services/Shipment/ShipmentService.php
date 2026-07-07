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

    public function startPicking(Shipment $shipment): Shipment
    {
        if ($shipment->status !== ShipmentStatus::PENDING) {
            throw new DomainException(
                'O pedido deve estar pendente.'
            );
        }

        $shipment->update([
            'status' => ShipmentStatus::PICKING,
        ]);

        return $shipment->fresh();
    }

    public function startPacking(Shipment $shipment): Shipment
    {
        if ($shipment->status !== ShipmentStatus::PICKING) {
            throw new DomainException(
                'O pedido deve estar em separação.'
            );
        }

        $shipment->update([
            'status' => ShipmentStatus::PACKING,
        ]);

        return $shipment->fresh();
    }

    public function startDispatching(Shipment $shipment): Shipment
    {
        if ($shipment->status !== ShipmentStatus::PACKING) {
            throw new DomainException(
                'O pedido deve estar empacotado.'
            );
        }

        $shipment->update([
            'status' => ShipmentStatus::DISPATCHING,
        ]);

        return $shipment->fresh();
    }

    public function ship(
        Shipment $shipment,
        string $carrier,
        string $trackingCode,
        array $payload = []
    ): Shipment {

        if ($shipment->status !== ShipmentStatus::DISPATCHING) {
            throw new DomainException(
                'O pedido deve estar em despacho.'
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
                'O pedido deve estar enviado.'
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
                'A encomenda não pode ser devolvida.'
            );
        }

        $shipment->update([
            'status' => ShipmentStatus::RETURNED,
            'returned_at' => now(),
        ]);

        return $shipment->fresh();
    }
}
