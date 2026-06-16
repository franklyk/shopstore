@extends('layouts.admin')

@section('title', 'Produtos')

@section('admin')
    <div class="container-fluid">

        <x-ui.page-header title="Produtos Cadastrados" description="Gerencie os produtos da loja">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Produtos']]" />
                <x-buttons.button href="{{ route('admin.products.create') }}" color="add" icon="plus" label="Novo" />
            </x-slot:actions>

        </x-ui.page-header>

        <table class="table-vs">
            <thead class="table-header">
                <tr>
                    <th>CÓDIGO</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td data-field="center">{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td data-field="center">R$ {{ $product->price }}</td>
                        <td data-field="center">{{ $product->stocks->first()?->quantity }}</td>
                        <td>
                            <x-buttons.button href="{{ route('products.show', $product) }}" color="view" icon="eye" />
                        </td>
                    </tr>

                @empty
                    <h1>Sem registros de Produtos</h1>
                @endforelse
            </tbody>

        </table>
        <div class="my-5">
            {{ $products->links() }}
        </div>

    </div>
    {{-- <div style="height: 2000px"></div> --}}

@endsection
