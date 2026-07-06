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

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light">
            <x-forms.form method="POST" action="{{ route('admin.products.store') }}" class="create-form" id="create-form"
                enctype="multipart/form-data">

                <div class="card border border-1 shadow container-image mb-5 rounded-4">

                    <div class="preview-image" id="preview-image">
                        <div class="preview-placeholder d-flex justify-content-center">
                            <x-icons.camera />
                        </div>
                    </div>
                    <label class="label-image" for="input-image">
                        <input class="input-image" type="file" name="input-image" id="input-image" accept="image/*">
                    </label>
                </div>

                <div class="card p-3 shadow">

                    <x-forms.input type="text" name="name" label="Nome:" value="{{ old('name') }}" required />

                    <x-forms.input type="text" name="price" label="Preço R$:" value="{{ old('price') }}" required />

                    <x-forms.input type="text" name="stock" label="Estoque:" required />

                    <x-forms.textarea label="Descrição:" name="description" required>
                        {{ old('description') }}
                    </x-forms.textarea>
                </div>

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
                                        <div class="">
                                            @forelse($parent->children as $child)
                                                <x-forms.checkbox name="categories[]" label="{{ $child->name }}"
                                                    value="{{ $child->id }}" :id="'category-' . $child->id" />
                                            @empty
                                                <small class="">Sem subcategorias</small>
                                            @endforelse
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col">
                                <h1 class="text-center text-danger mb-0">
                                    Nenhuma categoria cadastrada.
                                </h1>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.products.index') }}" color="secondary" icon="return"
                            label="Voltar" />
                    @endcan

                    @can('create products')
                        <x-buttons.button type="submit" form="create-form" color="success" icon="check" label="Cadastrar" />
                    @endcan

                </div>

            </x-forms.form>

        </div>
    </div>

@endsection
