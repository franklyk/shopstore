@extends('layouts.admin')

@section('title', 'Editar Produto')

@section('admin')

    <div class="page-container">
        <x-ui.page-header title="Editar Produto" description="Edite Qualquer Detalhe do Produto.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Produtos', 'url' => route('admin.products.index')],
                    ['label' => 'Visualizar', 'url' => route('admin.products.show', $product)],
                    ['label' => 'Editar'],
                ]" />

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5">
            <x-forms.form action="{{ route('admin.products.update', $product) }}" method="PUT" class="edit-form"
                id="edit-form">
                <x-forms.input type="text" name="name" label="Nome:" value="{{ $product->name }}" />

                <x-forms.input type="text" name="price" label="Preço R$:" value="{{ $product->price }}" />

                <x-forms.textarea label="Descrição:" name="description">
                    {{ $product->description }}
                </x-forms.textarea>

                <div class="card p-3 shadow">

                    <h3 class="fs-3 text-center section-title">Categorias</h3>

                    <div class="row g-2">
                        @if (!empty($categories))


                            @foreach ($categories as $parent)
                                <div class="col-3 border-light">

                                    <div class="bg-light border border-2 border-danger rounded p-4 ">
                                        <div class="text-center text-danger fw-bold fs-5">
                                            {{ $parent->name }}
                                        </div>
                                        <div class=" p-1 ms-2">
                                            @forelse($parent->children as $child)
                                                <x-forms.checkbox :name="$child->name" :label="$child->name"
                                                    value="{{ $child->id }}" id="{{ $child->slug }}" />
                                            @empty
                                                <small class="text-muted">Sem subcategorias</small>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col">
                                <h1 class="text-center text-danger mb-0">
                                    Nenhuma categoria cadastrada.
                                </p>
                            </div>

                        @endif
                    </div>

                </div>

                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.products.index') }}" color="secondary" icon="return"
                            label="Voltar" />
                    @endcan

                    @can('edit products')
                        <x-buttons.button type="submit" form="edit-form" color="warning" icon="edit" label="Salvar" />
                    @endcan

                </div>

            </x-forms.form>


        </div>
    </div>

@endsection
