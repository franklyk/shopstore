@extends('layouts.admin')

@section('title', 'Detalhe do Produto')

@section('content')

    <x-card title="Detalhes do Produto">

        <dl class="row">
            <x-detail-item label="Nome" :value="$product->name" />
            <x-detail-item label="Descrição" :value="$product->description" />
            <x-detail-item label="Preço" :value="$product->price" />
            <x-detail-item label="Estoque" :value="$product->stock" />
            <x-detail-item label="Cadastrado em" :value="$product->created_at" />
            <x-detail-item label="Última atualização em" :value="$product->updated_at" />
        </dl>

        @can('view products')
            <x-buttons.button href="{{ route('products.index') }}" color="secondary" icon="return" label="Voltar" />
        @endcan
        
        @can('edit products')
            <x-buttons.button href="{{ route('products.edit', $product) }}" color="warning" icon="edit" label="Editar" />
        @endcan

    </x-card>

@endsection
