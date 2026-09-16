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
                            <x-buttons.edit label="Editar" data-bs-toggle="modal" data-bs-target="#modal-edit" />
                        @endcan

                        @can('delete products')
                            <x-buttons.delete data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}" />
                        @endcan

                    </div>
                </x-slot:actions>

            </x-ui.page-header>
        </x-slot:header>

        @include('admin.products.partials.details', [
            'product' => $product,
        ])

        <x-modal.edit action="{{ route('admin.products.update', $product) }}">

            <div class="modal-container">

                <div class="modal-main">

                    <div class="modal-fields">

                        <x-forms.input type="text" name="name" label="Produto:" :value="old('name', $product->name)" />

                        <div class="auto-grid">

                            <x-forms.input type="number" name="price" label="Preço:" :value="old('price', $product->price)" step="0.01"
                                min="0" />

                            <x-forms.select name="brand_id" label="Marca:" :options="$brands->pluck('name', 'id')->toArray()" :selected="old('brand_id', $product->brand_id)" />

                            <x-forms.select name="collection_id" label="Coleção:" :options="$collections->pluck('name', 'id')->toArray()" :selected="old('collection_id', $product->collections->first()?->id)" />

                            <x-forms.select name="supplier_id" label="Fornecedor:" :options="$suppliers->pluck('name', 'id')->toArray()" :selected="old('supplier_id', $product->suppliers->first()?->id)" />

                        </div>

                    </div>

                    <div class="div">

                        <div class="modal-image">

                            <label class="modal-image-label" for="input-image">

                                <div class="modal-image-preview" id="preview-image">

                                    {{-- <x-icons.camera /> --}}

                                    @if ($product->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                            alt="{{ $product->name }}">
                                    @else
                                        <x-icons.camera />
                                    @endif

                                </div>

                            </label>

                            <input class="input-image" type="file" name="image" id="input-image" accept="image/*"
                                data-preview="#preview-image">

                        </div>

                        <x-buttons.status :statuses="$statuses" :status-id="$product->status_id" />

                    </div>

                </div>

                {{-- CATEGORIAS --}}

                <div class="modal-section">

                    <h3 class="section-title">
                        Categorias
                    </h3>

                    <div class="product-edit-categories checkbox-groups">

                        @foreach ($categories as $parent)
                            <div class="product-edit-category checkbox-options">

                                <div class="product-edit-category-parent checkbox-options-parent">
                                    {{ $parent->name }}
                                </div>

                                @forelse ($parent->children as $child)
                                    <x-forms.checkbox :name="'categories[]'" :label="$child->name" :value="$child->id"
                                        :id="'edit-category-' . $child->id" :checked="$product->categories->contains($child->id)" />

                                @empty

                                    <small class="text-muted">
                                        Sem subcategorias
                                    </small>
                                @endforelse

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

        </x-modal.edit>

        @section('modals')

            <x-modal.delete :id="$product->id" :action="route('admin.products.destroy', $product)" :name="$product->name" />

        @endsection

    </x-layout.admin.page>

@endsection
