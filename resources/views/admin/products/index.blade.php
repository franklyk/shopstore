@extends('layouts.admin')

@section('title', 'Produtos')

@section('content')
    <x-card title="Produtos Cadastrados">
        <x-slot:actions>

            @can('create products')
                <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 5v14" />
                        <path d="M5 12h14" />
                    </svg>

                    Novo
                </a>
            @endcan

        </x-slot:actions>
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
                                    <x-icons.eye />
                                </a>
                            @endcan

                            @can('edit products')
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">

                                    <x-icons.edit />

                                </a>
                            @endcan

                            @can('delete products')
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $product }}">

                                    <x-icons.trash />

                                </button>
                            @endcan

                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="mt-3">

            {{ $products->links() }}
        </div>

        @can('delete products')
            @foreach ($products as $product)
                <x-modal.delete :action="route('products.destroy', $product->id)" :id="$product->id" :name="$product->name" />
            @endforeach
        @endcan

    </x-card>

@endsection
