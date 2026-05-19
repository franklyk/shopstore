@extends('layouts.admin')

@section('title', 'Novo Produto')

@section('content')

    <x-card title="Novo Produto">
        <x-admin.forms.form action="{{ route('products.store') }}" method="POST">

            <x-admin.forms.row>
                <x-admin.forms.input type="text" name="name" label="Nome" />
            </x-admin.forms.row>

            <x-admin.forms.row>
                <x-admin.forms.textarea label="Descrição" name="description"></x-admin.forms.textarea>
            </x-admin.forms.row>

            <x-admin.forms.row>
                <x-admin.forms.input type="text" name="price" label="Preço" />
            </x-admin.forms.row>

            <x-admin.forms.row>
                <x-admin.forms.input type="text" name="stock" label="Estoque" />
            </x-admin.forms.row>

            <x-admin.forms.row>
                <div class="mb-3">
                    <p class="form-label">
                        <strong>Categorias</strong>
                    </p>

                    <div class="border rounded p-3">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                            @forelse($categories as $parent)
                                <div class="col">
                                    <div class="p-2 border rounded h-100">
                                        <div class="fw-bold text-primary mb-2">
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
                                </div>
                            @empty
                                <div class="col">
                                    <p class="text-muted mb-0">Nenhuma categoria cadastrada.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </x-admin.forms.row>

            @can('view products')
                <x-buttons.button href="{{ route('products.index') }}" color="secondary" icon="return" label="Voltar" />
            @endcan

            <x-buttons.button type="submit" color="success" label="Cadastrar" icon="check" />

        </x-admin.forms.form>
    </x-card>
    
@endsection
