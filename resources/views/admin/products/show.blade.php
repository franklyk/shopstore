@extends('layouts.admin')

@section('title', 'Detalhe do Produto')

@section('admin')
    <div class="page-container">
        <x-ui.page-header title="Detalhes do Produto" description="Visualize todos o detalhes do produto.">

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

        <div class="card p-5">

            <div class="card border border-1 shadow container-image mb-5">

                <div class="preview-image" id="preview-image">
                    @if ($product->image)
                        <img class="m-auto" src="{{ asset('storage/' . $product->image) }}" id="image">
                    @else
                        <div class="preview-placeholder d-flex justify-content-center">
                            <x-icons.camera />
                        </div>
                    @endif
                </div>
                <label class="label-image" for="input-image">
                    <input class="input-image" type="file" name="input-image" id="input-image" accept="image/*">
                </label>



            </div>

            <dl class="row">
                <dt class="col-md-6 fw-bolder text-secondary fs-5">Nome</dt>
                <dd class="col-md-6 fw-light text-danger">{{ $product->name }}</dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Descrição</dt>
                <dd class="col-md-6 fw-light text-danger">{{ $product->description }}</dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Categoria</dt>
                <dd class="col-md-6 fw-light text-danger">
                    @foreach ($product->categories as $category)
                        {{ $category->name }} /
                    @endforeach
                </dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Status</dt>
                <dd class="col-md-6 fw-light text-danger">
                    <span class="badge text-bg-{{ $product->status->color }}">
                        {{ $product->status->name }}
                    </span>
                </dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Preço</dt>
                <dd class="col-md-6 fw-light text-danger">R$ {{ $product->price }}</dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Estoque</dt>
                <dd class="col-md-6 fw-light text-danger">{{ $product->stocks->first()?->quantity ?? 0 }}</dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Cadastrado em</dt>
                <dd class="col-md-6 fw-light text-danger">{{ $product->created_at }}</dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Última atualização em </dt>
                <dd class="col-md-6 fw-light text-danger">{{ $product->updated_at }}</dd>
            </dl>
        </div>
    </div>

@section('modals')
    @can('delete products')
        <x-modal.delete :action="route('admin.products.destroy', $product)" :id="$product->id" :name="$product->name" />
    @endcan
@endsection

@endsection
