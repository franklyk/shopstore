@extends('layouts.admin')

@section('title', 'Shipment #' . $shipment->id)

@section('admin')

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

            <h3>Fluxo Operacional</h3>

            <hr>

            <div class="d-flex flex-wrap gap-2">

                <span class="badge bg-secondary">
                    Pedido Pago
                </span>

                <span class="badge {{ in_array($shipment->status->value, ['picking','packing','dispatching','shipped','delivered','returned']) ? 'bg-success' : 'bg-light text-dark' }}">
                    Separação
                </span>

                <span class="badge {{ in_array($shipment->status->value, ['packing','dispatching','shipped','delivered','returned']) ? 'bg-success' : 'bg-light text-dark' }}">
                    Empacotamento
                </span>

                <span class="badge {{ in_array($shipment->status->value, ['dispatching','shipped','delivered','returned']) ? 'bg-success' : 'bg-light text-dark' }}">
                    Despacho
                </span>

                <span class="badge {{ in_array($shipment->status->value, ['shipped','delivered','returned']) ? 'bg-success' : 'bg-light text-dark' }}">
                    Enviado
                </span>

                <span class="badge {{ $shipment->status->value === 'delivered' ? 'bg-success' : 'bg-light text-dark' }}">
                    Entregue
                </span>

                @if($shipment->status->value === 'returned')
                    <span class="badge bg-warning text-dark">
                        Devolvido
                    </span>
                @endif

            </div>

        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">

            <h3>Ações</h3>

            <hr>

            @if($shipment->status->value === 'pending')

                <form
                    action="{{ route('admin.shipments.pick', $shipment) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Iniciar Separação
                    </button>
                </form>

            @endif

            @if($shipment->status->value === 'picking')

                <form
                    action="{{ route('admin.shipments.pack', $shipment) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Finalizar Separação
                    </button>
                </form>

            @endif

            @if($shipment->status->value === 'packing')

                <form
                    action="{{ route('admin.shipments.dispatch', $shipment) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Liberar para Despacho
                    </button>
                </form>

            @endif

            @if($shipment->status->value === 'dispatching')

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
                        Enviar Pedido
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
