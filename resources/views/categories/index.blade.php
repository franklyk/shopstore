@extends('layouts.app')

@section('title', 'Categorias')

@section('content')


    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary mb-3">
        Novo Produto
    </a>
    <div class="card p-4">
        <div class="card-header">
            <div class="card-title">
                <h2>
                    Nova Categoria
                </h2>
            </div>
        </div>
        
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th scope="col">COD</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">
                    @foreach ($categories as $product)
                        <tr class="text-center">
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>
                                <a href="{{ route('categories.show', $product) }}" class="btn btn-sm btn-info">
                                    Visualizar
                                </a>

                                <a href="{{ route('categories.edit', $product) }}" class="btn btn-sm btn-warning">
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
    </div>
    @foreach ($categories as $product)
        <x-modal.delete :action="route('products.destroy', $product->id)" :id="$product->id" :name="$product->name" />
    @endforeach

@endsection
