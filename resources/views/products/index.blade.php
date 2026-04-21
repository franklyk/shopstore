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
                    <td>R$ {{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>

                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">
                            Ver
                        </a>

                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $product->id }}">
                            Excluir
                        </button>

                        <x-modal :product="$product" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

@endsection
