@extends('layouts.admin')

@section('title', 'Produtos')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <div class="card-title">
                <h2>Produtos Cadastrados</h2>
            </div>
            @can('create products')
                <a href="{{ route('products.create') }}" class="ms-auto btn btn-sm btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 5v14" />
                        <path d="M5 12h14" />
                    </svg>

                    Novo
                </a>
            @endcan

        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="text-center">
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
                                @can('view products')
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </a>
                                @endcan

                                @can('edit products')
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                        </svg>
                                    </a>
                                @endcan

                                @can('delete products')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $product }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M3 6h18" />
                                            <path d="M8 6V4h8v2" />
                                            <path d="M19 6l-1 14H6L5 6" />
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />
                                        </svg>
                                    </button>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        @can('delete products')
            @foreach ($products as $product)
                <x-modal.delete :action="route('products.destroy', $product->id)" :id="$product->id" :name="$product->name" />
            @endforeach
        @endcan

        {{ $products->links() }}
    @endsection
