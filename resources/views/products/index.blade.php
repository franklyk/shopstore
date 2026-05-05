@extends('layouts.app')

@section('title', 'Produtos')

@section('content')

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
        Novo Produto
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>R$ {{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>

                        <x-buttons.button href="{{ route('products.show', $product) }}" color="info">
                            Editar
                        </x-buttons.button>

                        <x-buttons.button href="{{ route('products.edit', $product) }}" color="warning">
                            Editar
                        </x-buttons.button>

                        <x-buttons.button type="button" color="danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            data-id="{{ $product->id }}" data-name="Produto {{ $product->name }}">
                            Excluir
                        </x-buttons.button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-modal.delete />

@endsection
