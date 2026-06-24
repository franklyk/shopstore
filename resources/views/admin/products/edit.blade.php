@extends('layouts.admin')

@section('title', 'Editar Produto')

@section('admin')

    <div class="container-fluid">
        <x-ui.page-header title="Editar Produto" description="Edite Qualquer Detalhe do Produto.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Produtos', 'url' => route('admin.products.index')],
                    ['label' => 'Visualizar', 'url' => route('admin.products.show', $product )],
                    ['label' => 'Editar'],
                ]" />
                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.products.index') }}" color="return" icon="return" label="Voltar" />
                    @endcan

                    @can('edit products')
                        <x-buttons.button type="submit" form="edit-form" color="edit" icon="edit" label="Salvar" />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card-vs">
            <x-forms.form action="{{ route('admin.products.update', $product) }}" method="PUT" class="edit-form" id="edit-form">
                <x-forms.row>
                    <x-forms.input type="text" name="name" label="Nome:" value="{{ $product->name }}" />
                </x-forms.row>

                <x-forms.row>
                    <x-forms.input type="text" name="price" label="Preço R$:" value="{{ $product->price }}" />
                </x-forms.row>

                {{-- <x-forms.row>
                    <x-forms.input type="text" name="stock" label="Estoque:"
                        value="{{ $product->stocks->first()?->quantity ?? 0 }}" />
                </x-forms.row> --}}

                <x-forms.row>
                    <x-forms.textarea label="Descrição:" name="description">
                        {{ $product->description }}
                    </x-forms.textarea>
                </x-forms.row>

                <x-forms.row>
                    <div class="card-vs">

                        <h3 class="section-title">Categorias</h3>

                        <div class="auto-grid">
                            @forelse($categories as $parent)
                                    <div class="card-vs">
                                        <div class="section-title text-center">
                                            {{ $parent->name }}
                                        </div>
                                        <div class="ms-2">
                                            @forelse($parent->children as $child)
                                                <x-admin.forms.checkbox :name="$child->name" :label="$child->name"
                                                    value="{{ $child->id }}" id="{{ $child->slug }}" />
                                            @empty
                                                <small class="text-muted">Sem subcategorias</small>
                                            @endforelse
                                        </div>

                                    </div>

                            @empty
                                <div class="col">
                                    <p class="text-muted mb-0">Nenhuma categoria cadastrada.</p>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </x-forms.row>


            </x-forms.form>

        </div>
    </div>

@endsection
