@extends('layouts.admin')

@section('title', 'Detalhe do Produto')

@section('admin')
    <div class="container-fluid">
        <x-ui.page-header title="Detalhes do Produto" description="Visualize todos o detalhes do produto.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Produtos', 'url' => route('admin.products.index')],
                    ['label' => 'Visualizar'],
                ]" />
                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.products.index') }}" color="return" icon="return" label="Voltar" />
                    @endcan

                    @can('edit products')
                        <x-buttons.button href="{{ route('admin.products.edit', $product) }}" color="edit" icon="edit"
                            label="Editar" />
                    @endcan

                    @can('delete products')
                        <x-buttons.button color="delete" icon="trash" label="Excluir" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $product->id }} " />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card-vs">

            <dl class="desc-list">
                <dt>Nome</dt>
                <dd>{{ $product->name }}</dd>

                <dt>Descrição</dt>
                <dd>{{ $product->description }}</dd>

                <dt>Preço</dt>
                <dd>R$ {{ $product->price }}</dd>

                <dt>Estoque</dt>
                <dd>{{ $product->stocks->first()?->quantity ?? 0 }}</dd>

                <dt>Cadastrado em</dt>
                <dd>{{ $product->created_at }}</dd>

                <dt>Última atualização em </dt>
                <dd>{{ $product->updated_at }}</dd>
            </dl>
        </div>
    </div>

    @section('modals')
        @can('delete products')
            <x-modal.delete :action="route('admin.products.destroy', $product)" :id="$product->id" :name="$product->name" />
        @endcan
    @endsection

@endsection
