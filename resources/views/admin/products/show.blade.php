@extends('layouts.admin')

@section('title', 'Detalhe do Produto')

@section('layout-admin')

    <x-layout.admin.page>
        <x-slot:header>
            <x-ui.page-header title="Detalhes do Produto">

                <x-slot:actions>
                    <x-ui.breadcrumbs :items="[
                        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                        ['label' => 'Produtos', 'url' => route('admin.products.index')],
                        ['label' => 'Visualizar'],
                    ]" />
                    <div class="container-buttons">
                        @can('view products')
                            <x-buttons.button href="{{ route('admin.products.index') }}" color="secondary" icon="return"
                                label="Voltar" />
                        @endcan

                        @can('edit products')
                            <x-buttons.button href="{{ route('admin.products.edit', $product) }}" color="warning" icon="edit"
                                label="Editar" />
                        @endcan

                        @can('delete products')
                            <x-buttons.button color="danger" icon="trash" label="Excluir" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $product->id }} " />
                        @endcan

                    </div>
                </x-slot:actions>

            </x-ui.page-header>
        </x-slot:header>

        @include('admin.products.partials.details', [
            'product' => $product,
        ])

        {{-- <div class="details">

            <div class="container-image">

                @if ($product->images->isNotEmpty())
                    <div class="preview-image" id="preview-image">
                        <img src="{{ asset('storage/' . $product->images->first()->image) }}" class="image"
                            alt="{{ $product->name }}">
                    </div>
                @else
                    <div class="preview-placeholder">
                        <x-icons.camera />
                    </div>
                @endif

                <label class="label-image" for="input-image">

                    <input class="input-image" type="file" name="input-image" id="input-image" accept="image/*">

                </label>

            </div>

            <dl class="details-list">

                <dt class="details-label">Nome</dt>
                <dd class="details-value">{{ $product->name }}</dd>

                <dt class="details-label">Descrição</dt>
                <dd class="details-value">{{ $product->description }}</dd>

                <dt class="details-label">Categoria</dt>
                <dd class="details-value">
                    @foreach ($product->categories as $category)
                        {{ $category->name }} /
                    @endforeach
                </dd>

                <dt class="details-label">Status</dt>
                <dd class="details-value">
                    <span class="badge-status badge-status-{{ $product->status->color }}">
                        {{ $product->status->name }}
                    </span>
                </dd>

                <dt class="details-label">Preço</dt>
                <dd class="details-value">R$ {{ $product->price }}</dd>

                <dt class="details-label">Estoque</dt>
                <dd class="details-value">
                    {{ $product->stocks->first()?->quantity ?? 0 }}
                </dd>

                <dt class="details-label">Cadastrado em</dt>
                <dd class="details-value">{{ $product->created_at }}</dd>

                <dt class="details-label">Última atualização em</dt>
                <dd class="details-value">{{ $product->updated_at }}</dd>

            </dl>

        </div> --}}

    </x-layout.admin.page>

@endsection
