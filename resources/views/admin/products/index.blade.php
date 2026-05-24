@extends('layouts.admin')

@section('title', 'Produtos')

@section('content')
    <x-card title="Produtos Cadastrados">
        <x-slot:actions>

            @can('create products')
                <x-buttons.button href="{{ route('admin.products.create') }}" color="primary" icon="plus" label="Novo" />
            @endcan

        </x-slot:actions>
        <x-admin.table.table>
            <x-admin.table.thead :columns="['CÓDIGO', 'Nome', 'Descrição', 'Preço', 'Estoque', 'Ações']" />

            <x-admin.table.tbody>
                @forelse ($products as $product)
                    <tr>
                        <th scope="row" class="text-center">{{ $product->id }}</th>
                        <x-admin.table.td value="{{ $product->name }}" />
                        <x-admin.table.td value="{{ $product->description }}" />
                        <x-admin.table.td value="R$ {{ $product->price }}" />
                        <x-admin.table.td value="{{ $product->stock }}" />

                        <x-admin.table.td>
                            <x-admin.table.actions :item="$product" :view="route('products.show', $product)" :edit="route('admin.products.edit', $product)" :delete="route('admin.products.destroy', $product)"
                                permission="products" />
                        </x-admin.table.td>
                    </tr>
                @empty

                    <tr>

                        <x-admin.table.td colspan="6" class="text-center text-muted py-4">
                            Nenhum produto encontrado.
                        </x-admin.table.td>

                    </tr>
                @endforelse
            </x-admin.table.tbody>

        </x-admin.table.table>
        <div class="mt-5">

            {{ $products->links() }}
        </div>

        @can('delete products')
            @foreach ($products as $product)
                <x-modal.delete :action="route('admin.products.destroy', $product->id)" :id="$product->id" :name="$product->name" />
            @endforeach
        @endcan

    </x-card>

@endsection
