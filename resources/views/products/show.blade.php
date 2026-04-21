@extends('layouts.app')

@section('content')

<h2>Detalhes do Produto</h2>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>

        <p><strong>Preço:</strong> R$ {{ $product->price }}</p>
        <p><strong>Estoque:</strong> {{ $product->stock }}</p>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            Voltar
        </a>

        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
            Editar
        </a>
    </div>
</div>

@endsection