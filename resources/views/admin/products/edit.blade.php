@extends('layouts.admin')

@section('title', 'Editar Produto')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <div class="card-title">
                <h2>Editar Produto</h2>
            </div>
        </div>

        <div class="card-body">

            <x-admin.forms.form method="PUT" action="{{ route('products.update', $product) }}">

                <x-admin.forms.row>
                    <x-admin.forms.input type="text" name="name" label="Nome"/>
                </x-admin.forms.row>


                <x-admin.forms.row>
                    <x-admin.forms.input />
                    <div class="mb-3">
                        <label for="description" class="form-label"><strong>Descrição</strong></label>
                        <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                    </div>
                </x-admin.forms.row>

                <x-admin.forms.row>
                    <x-admin.forms.input type="text" name="price" label="Preço" />
                    {{-- <div class="mb-3">
                        <label for="price" class="form-label"><strong>Preço</strong></label>
                        <input type="text" class="form-control" id="price" name="price"
                            value="{{ old('price', $product->price) }}">
                    </div> --}}
                </x-admin.forms.row>

                <x-admin.forms.row>
                    <x-admin.forms.input type="text" name="stock" />
                    <div class="mb-3">
                        <label for="stock" class="form-label"><strong>Estoque</strong></label>
                        <input type="text" class="form-control" id="stock" name="stock"
                            value="{{ old('stock', $product->stock) }}">
                    </div>
                </x-admin.forms.row>

                <x-admin.forms.row>
                    <div class="mb-3">
                        <label for="" class="form-label"><strong>Categorias</strong></label>

                        <div class="border rounded p-3">

                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">

                                @foreach ($categories as $parent)
                                    <div class="col">

                                        <div class="p-2 border rounded h-100">

                                            <div class="fw-bold text-primary mb-2">
                                                {{ $parent->name }}
                                            </div>

                                            <div class="ms-2">

                                                @forelse($parent->children as $child)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                                            value="{{ $child->id }}" id="cat_{{ $child->id }}"
                                                            @checked($product->categories->contains($child->id))>

                                                        <label class="form-check-label" for="cat_{{ $child->id }}">
                                                            {{ $child->name }}
                                                        </label>
                                                    </div>
                                                @empty
                                                    <small class="text-muted">Sem subcategorias</small>
                                                @endforelse

                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </x-admin.forms.row>

                @can('view products')
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">

                        <x-icons.return/>

                        Voltar
                    </a>
                @endcan

                <button type="submit" class="btn btn-sm btn-warning" form="edit-form">
                    <strong>
                        
                        <x-icons.check/>

                        Salvar
                    </strong>
                </button>

            </x-admin.forms.form>
        </div>
    </div>

@endsection
