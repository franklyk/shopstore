@extends('layouts.app')

@section('title', 'Produtos')

@section('content')



    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary mb-3">
        Novo Produto
    </a>
    <div class="card p-4">
        <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">COD</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Estoque</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>R$ {{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">
                                Visualizar
                            </a>

                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">
                                Editar
                            </a>

                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $product->id }}">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    @foreach ($products as $product)
        <x-modal.delete :action="route('products.destroy', $product->id)" :id="$product->id" :name="$product->name" />
    @endforeach

@endsection
