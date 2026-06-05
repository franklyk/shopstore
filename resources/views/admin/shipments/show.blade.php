@extends('layouts.admin')

@section('title', 'Shipment #'.$shipment->id)

@section('content')

<div class="container">

    <h1 class="mb-4">
        Shipment #{{ $shipment->id }}
    </h1>

    <div class="card mb-4">
        <div class="card-body">

            <h3>Informações Gerais</h3>

            <hr>

            <p>
                <strong>Pedido:</strong>
                #{{ $shipment->order_id }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ $shipment->status->value }}
            </p>

            <p>
                <strong>Transportadora:</strong>
                {{ $shipment->carrier ?? 'Não informado' }}
            </p>

            <p>
                <strong>Código de rastreio:</strong>
                {{ $shipment->tracking_code ?? 'Não informado' }}
            </p>

            <p>
                <strong>Enviado em:</strong>
                {{ $shipment->shipped_at?->format('d/m/Y H:i') ?? '-' }}
            </p>

            <p>
                <strong>Entregue em:</strong>
                {{ $shipment->delivered_at?->format('d/m/Y H:i') ?? '-' }}
            </p>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">

            <h3>Fluxo Logístico</h3>

            <hr>

            <div style="font-size:18px">

                Pedido Pago

                →

                <strong @class([
                    'text-success' => in_array(
                        $shipment->status->value,
                        ['processing','shipped','delivered','returned']
                    )
                ])>
                    Processing
                </strong>

                →

                <strong @class([
                    'text-success' => in_array(
                        $shipment->status->value,
                        ['shipped','delivered','returned']
                    )
                ])>
                    Shipped
                </strong>

                →

                <strong @class([
                    'text-success' => in_array(
                        $shipment->status->value,
                        ['delivered']
                    )
                ])>
                    Delivered
                </strong>

                →

                <strong @class([
                    'text-warning' => $shipment->status->value === 'returned'
                ])>
                    Returned
                </strong>

            </div>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">

            <h3>Ações</h3>

            <hr>

            @if($shipment->status->value === 'pending')

                <form
                    action="{{ route('admin.shipments.process', $shipment) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Iniciar Processamento
                    </button>
                </form>

            @endif

            @if($shipment->status->value === 'processing')

                <form
                    action="{{ route('admin.shipments.ship', $shipment) }}"
                    method="POST"
                >
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Transportadora
                        </label>

                        <input
                            type="text"
                            name="carrier"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Código de Rastreio
                        </label>

                        <input
                            type="text"
                            name="tracking_code"
                            class="form-control"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        Despachar
                    </button>
                </form>

            @endif

            @if($shipment->status->value === 'shipped')

                <form
                    action="{{ route('admin.shipments.deliver', $shipment) }}"
                    method="POST"
                    class="mb-2"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        Marcar como Entregue
                    </button>
                </form>

                <form
                    action="{{ route('admin.shipments.return', $shipment) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-warning"
                    >
                        Marcar como Devolvido
                    </button>
                </form>

            @endif

            @if($shipment->status->value === 'delivered')

                <form
                    action="{{ route('admin.shipments.return', $shipment) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-warning"
                    >
                        Registrar Devolução
                    </button>
                </form>

            @endif

        </div>
    </div>

</div>

@endsection
