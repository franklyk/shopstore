@extends('layouts.admin')

@section('content')

    <h1>Pedidos</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach($orders as $order)

                <tr>
                    <td>{{ $order->id }}</td>

                    <td>{{ $order->customer_name }}</td>

                    <td>
                        R$ {{ number_format($order->total, 2, ',', '.') }}
                    </td>

                    <td>{{ $order->status }}</td>
                </tr>

            @endforeach

        </tbody>
    </table>

@endsection
