@extends('layouts.admin')

@section('title', 'Novo Produto')

@section('admin')

    <div class="container-fluid">
        <x-ui.page-header title="Novo Produto" description="Edite Qualquer Detalhe do Produto.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Produtos', 'url' => route('admin.products.index')],
                    ['label' => 'Cadastrar'],
                ]" />
                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.products.index') }}" color="return" icon="return" label="Voltar" />
                    @endcan

                    @can('edit products')
                        <x-buttons.button for="edit-form" color="edit" icon="edit" label="Cadastrar" />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card-vs">
            <x-forms.form action="{{ route('admin.products.store') }}" class="edit-form" id="edit-form"
                enctype="multipart/form-data">

                <input id="images" type="file" name="images[]" multiple accept="image/*">
                
                <x-forms.row>
                    <x-forms.input type="text" name="name" label="Nome:" value="{{ old('name') }}" required />
                </x-forms.row>

                <x-forms.row>
                    <x-forms.input type="text" name="price" label="Preço R$:" value="{{ old('') }}" required />
                </x-forms.row>

                <x-forms.row>
                    <x-forms.input type="text" name="stock" label="Estoque:" required />
                </x-forms.row>

                <x-forms.row>
                    <x-forms.textarea label="Descrição:" name="description" required>
                        {{ old('description') }}
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
