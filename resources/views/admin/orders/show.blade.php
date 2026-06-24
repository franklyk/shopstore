@extends('layouts.admin')

@section('title', 'Pedido #' . $order->id)

@section('admin')

    <div class="page-container">

        <x-ui.page-header title="Pedido" description="Gerencie o Pedido">

            <x-slot:actions>

                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Envios']]" />

            </x-slot:actions>

        </x-ui.page-header>

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1 class="mb-0">
                Pedido #{{ $order->id }}
            </h1>

            @if ($order->shipment)
                <a href="{{ route('admin.shipments.show', $order->shipment) }}" class="btn btn-primary">
                    Abrir Expedição
                </a>
            @endif

        </div>

        <div class="row">

            <div class="col-lg-8">

                {{-- Pedido --}}
                <div class="card mb-4">

                    <div class="card-header">
                        Dados do Pedido
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <p>
                                    <strong>ID:</strong>
                                    #{{ $order->id }}
                                </p>

                                <p>
                                    <strong>Status:</strong>
                                    {{ $order->status }}
                                </p>

                                <p>
                                    <strong>Pagamento:</strong>

                                    @if ($order->paid_at)
                                        <span class="badge bg-success">
                                            Pago
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            Pendente
                                        </span>
                                    @endif

                                </p>

                                <p>
                                    <strong>Método:</strong>
                                    {{ $order->payment_method }}
                                </p>

                            </div>

                            <div class="col-md-6">

                                <p>
                                    <strong>Criado em:</strong>
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </p>

                                <p>
                                    <strong>Pago em:</strong>

                                    @if ($order->paid_at)
                                        {{ $order->paid_at->format('d/m/Y H:i') }}
                                    @else
                                        —
                                    @endif

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Produtos --}}
                <div class="card mb-4">

                    <div class="card-header">
                        Produtos do Pedido
                    </div>

                    <div class="card-body p-0">

                        <table class="table table-hover mb-0">

                            <thead>

                                <tr>
                                    <th>Produto</th>
                                    <th>Qtd</th>
                                    <th>Preço</th>
                                    <th>Subtotal</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($order->items as $item)
                                    <tr>

                                        <td>
                                            {{ $item->product?->name }}
                                        </td>

                                        <td>
                                            {{ $item->quantity }}
                                        </td>

                                        <td>
                                            R$ {{ number_format($item->price, 2, ',', '.') }}
                                        </td>

                                        <td>
                                            R$ {{ number_format($item->quantity * $item->price, 2, ',', '.') }}
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- Endereço --}}
                <div class="card mb-4">

                    <div class="card-header">
                        Endereço de Entrega
                    </div>

                    <div class="card-body">

                        <p>
                            <strong>CEP:</strong>
                            {{ $order->zipcode }}
                        </p>

                        <p>
                            <strong>Rua:</strong>
                            {{ $order->street }}
                        </p>

                        <p>
                            <strong>Número:</strong>
                            {{ $order->number }}
                        </p>

                        <p>
                            <strong>Complemento:</strong>
                            {{ $order->complement ?: '-' }}
                        </p>

                        <p>
                            <strong>Bairro:</strong>
                            {{ $order->district }}
                        </p>

                        <p>
                            <strong>Cidade:</strong>
                            {{ $order->city }}
                        </p>

                        <p>
                            <strong>Estado:</strong>
                            {{ $order->state }}
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                {{-- Cliente --}}
                <div class="card mb-4">

                    <div class="card-header">
                        Cliente
                    </div>

                    <div class="card-body">

                        <p>
                            <strong>Nome:</strong>
                            {{ $order->customer_name }}
                        </p>

                        @if ($order->user)
                            <p>
                                <strong>Usuário:</strong>
                                {{ $order->user->name }}
                            </p>

                            <p>
                                <strong>Email:</strong>
                                {{ $order->user->email }}
                            </p>
                        @endif

                    </div>

                </div>

                {{-- Resumo Financeiro --}}
                <div class="card mb-4">

                    <div class="card-header">
                        Financeiro
                    </div>

                    <div class="card-body">

                        <p>
                            <strong>Subtotal:</strong><br>
                            R$ {{ number_format($order->subtotal, 2, ',', '.') }}
                        </p>

                        <p>
                            <strong>Frete:</strong><br>
                            R$ {{ number_format($order->shipping, 2, ',', '.') }}
                        </p>

                        <p>
                            <strong>Desconto:</strong><br>
                            R$ {{ number_format($order->discount, 2, ',', '.') }}
                        </p>

                        <hr>

                        <h4>
                            R$ {{ number_format($order->total, 2, ',', '.') }}
                        </h4>

                    </div>

                </div>

                {{-- Operação --}}
                <div class="card mb-4">

                    <div class="card-header">
                        Operação
                    </div>

                    <div class="card-body">

                        @if ($order->shipment)
                            <p>
                                <strong>Status Logístico:</strong>
                            </p>

                            <span class="badge bg-primary">
                                {{ strtoupper($order->shipment->status->value) }}
                            </span>

                            <hr>

                            <a href="{{ route('admin.shipments.show', $order->shipment) }}"
                                class="btn btn-outline-primary w-100">
                                Gerenciar Shipment
                            </a>
                        @else
                            <p class="mb-0">
                                Nenhum shipment encontrado.
                            </p>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
