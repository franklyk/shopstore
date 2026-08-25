@extends('layouts.admin')

@section('title', 'Novo Produto')

@section('admin')

    <x-layout.admin.crud.editors>

        <x-ui.page-header title="Novo Produto">
            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Produtos', 'url' => route('admin.products.index')],
                    ['label' => 'Cadastrar'],
                ]" />
            </x-slot:actions>
        </x-ui.page-header>

        <x-slot:body>
            <x-forms.form action="{{ route('admin.products.create') }}" method="PUT" class="edit-form" id="edit-form"
                enctype="multipart/form-data">
                <div class="container-image mb-5 rounded">
                    <div class="preview-image" id="preview-image">
                        <div class="preview-placeholder d-flex justify-content-center">
                            <x-icons.camera />
                        </div>
                    </div>
                    <label class="label-image" for="input-image">
                        <input class="input-image" type="file" name="input-image" id="input-image" accept="image/*">
                    </label>


                </div>
                <div class="card p-3">

                    <x-forms.input type="text" name="name" label="Nome:" value="{{ old('name') }}" />
                    <x-forms.input type="text" name="price" label="Preço R$:" value="{{ old('price') }}" />
                    <x-forms.textarea label="Descrição:" name="description">
                        {{ old('description') }}
                    </x-forms.textarea>


                    <div class="p-3">

                        <h3 class="fs-3 text-center section-title">Categorias</h3>

                        <div class="row g-2">
                            @if (!empty($categories))
                                @foreach ($categories as $parent)
                                    <div class="col-3">

                                        <div class="p-4 ">
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
                                    </h1>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            </x-forms.form>

            <x-slot:button>

                @can('view products')
                    <x-buttons.button href="{{ route('admin.products.index') }}" color="secondary" icon="return"
                        label="Voltar" />
                @endcan

                @can('edit products')
                    <x-buttons.button type="submit" form="edit-form" color="warning" icon="edit" label="Salvar" />
                @endcan

            </x-slot:button>

        </x-slot:body>

    </x-layout.admin.crud.editors>

@endsection
