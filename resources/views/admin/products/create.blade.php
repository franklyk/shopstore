@extends('layouts.admin')

@section('title', 'Novo Produto')

@section('admin')

    <div class="editors page-container">
        <x-ui.page-header title="Novo Produto" description="Cadastre um Novo Produto.">

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

                    @can('create products')
                        <x-buttons.button type="submit" form="create-form" color="add" icon="check" label="Cadastrar" />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card">
            <x-forms.form method="POST" action="{{ route('admin.products.store') }}" class="create-form" id="create-form"
                enctype="multipart/form-data">

                <section class="container-image">

                    <div class="image-preview" id="preview-image">

                        <label class="label-image" for="input-image">
                        </label>
                        <input class="input-image" type="file" name="input-image" id="input-image" accept="image/*">

                    </div>


                </section>

                <x-forms.row>
                    <x-forms.input type="text" name="name" label="Nome:" value="{{ old('name') }}" required />
                </x-forms.row>

                <x-forms.row>
                    <x-forms.input type="text" name="price" label="Preço R$:" value="{{ old('price') }}" required />
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
                    <div class="card">

                        <h3 class="section-title">Categorias</h3>

                        <div class="categories-container">
                            @forelse($categories as $parent)
                                <div class="card-vs">
                                    <div class="section-title">
                                        {{ $parent->name }}
                                    </div>
                                    <div class="">
                                        @forelse($parent->children as $child)
                                            <x-admin.forms.checkbox name="categories[]" :label="$child->name"
                                                value="{{ $child->id }}" id="{{ $child->slug }}" />
                                        @empty
                                            <small class="">Sem subcategorias</small>
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
