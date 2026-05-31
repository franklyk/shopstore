<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Services\Shipment\ShipmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShipmentController extends Controller
{
    public function index(): View
    {
        $shipments = Shipment::query()
            ->with('order')
            ->latest()
            ->paginate();

        return view('admin.shipments.index', compact('shipments'));
    }

    public function show(Shipment $shipment): View
    {
        $shipment->load('order');

        return view('admin.shipments.show', compact('shipment'));
    }

    public function process(
        Shipment $shipment,
        ShipmentService $service
    ): RedirectResponse {
        $service->process($shipment);

        return back();
    }

    public function ship(
        Shipment $shipment,
        ShipmentService $service
    ): RedirectResponse {
        $service->ship(
            shipment: $shipment,
            carrier: request('carrier'),
            trackingCode: request('tracking_code')
        );

        return back();
    }

    public function deliver(
        Shipment $shipment,
        ShipmentService $service
    ): RedirectResponse {
        $service->deliver($shipment);

        return back();
    }

    public function markAsReturned(
        Shipment $shipment,
        ShipmentService $service
    ): RedirectResponse {
        $service->markAsReturned($shipment);

        return back();
    }
}