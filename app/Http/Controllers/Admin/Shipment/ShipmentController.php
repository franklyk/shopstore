<?php

namespace App\Http\Controllers\Admin\Shipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Shipment\ShipShipmentRequest;
use App\Models\Shipment\Shipment;
use App\Services\Admin\Order\ShipmentService;
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

    public function pick(
        Shipment $shipment,
        ShipmentService $service
    ): RedirectResponse {
        $service->startPicking($shipment);

        return back();
    }

    public function pack(
        Shipment $shipment,
        ShipmentService $service
    ): RedirectResponse {
        $service->startPacking($shipment);

        return back();
    }

    public function dispatch(
        Shipment $shipment,
        ShipmentService $service
    ): RedirectResponse {
        $service->startDispatching($shipment);

        return back();
    }

    public function ship(
        ShipShipmentRequest $request,
        Shipment $shipment,
        ShipmentService $service
    ): RedirectResponse {

        $data = $request->validated();

        $service->ship(
            shipment: $shipment,
            carrier: $data['carrier'],
            trackingCode: $data['tracking_code']
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
