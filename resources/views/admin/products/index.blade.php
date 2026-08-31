@extends('layouts.admin')

@section('title', 'Produtos')

@section('layout-admin')

    <x-layout.admin.page>
        <x-slot:header>
            <x-ui.page-header title="Produtos Cadastrados">

                <x-slot:actions>

                    <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Produtos']]" />

                    <div class="d-flex gap-2">

                        <x-buttons.button type="button" color="success" icon="plus" label="Novo" data-bs-toggle="modal"
                            data-bs-target="#createProductModal" />

                    </div>

                </x-slot:actions>

            </x-ui.page-header>

        </x-slot:header>

        @if (!empty($products))
            <x-layout.admin.crud.listing :links="$products">
                <x-slot:table>

                    <thead>

                        <tr>

                            <th scope="col">CÓDIGO</th>
                            <th scope="col">NOME</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">MARCA</th>
                            <th scope="col">FORNECEDOR</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($products as $product)
                            <tr scope="row" class="clickable-row"
                                data-href="{{ route('admin.products.show', $product) }}">

                                <td>{{ $product->sku }}</td>

                                <td>{{ $product->name }}</td>

                                <td>

                                    <span class="badge text-bg-{{ $product->status->color }}">
                                        {{ $product->status->name }}
                                    </span>

                                </td>

                                <td>{{ $product->brand?->name }}</td>

                                <td>
                                    {{ $product->suppliers->pluck('name')->join(', ') }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </x-slot:table>

                <x-slot:sidebar>

                    <x-forms.form method="GET">

                        <div class="accordion" id="productFilters">

                            {{-- BRANDS --}}

                            <div class="accordion-item">

                                <h2 class="accordion-header" id="headingBrands">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseBrands" aria-expanded="false"
                                        aria-controls="collapseBrands">
                                        Marcas
                                    </button>

                                </h2>

                                <div id="collapseBrands" class="accordion-collapse collapse"
                                    aria-labelledby="headingBrands">

                                    <div class="accordion-body">

                                        @foreach ($brands as $brand)
                                            <x-forms.checkbox name="brand[]" label="{{ $brand->name }}"
                                                value="{{ $brand->id }}" :id="'brand-' . $brand->id" :checked="in_array($brand->id, request('brand', []))" />
                                        @endforeach

                                    </div>

                                </div>

                            </div>


                            {{-- SUPPLIERS --}}

                            <div class="accordion-item">

                                <h2 class="accordion-header" id="headingSuppliers">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSuppliers" aria-expanded="false"
                                        aria-controls="collapseSuppliers">
                                        Fornecedores
                                    </button>

                                </h2>

                                <div id="collapseSuppliers" class="accordion-collapse collapse"
                                    aria-labelledby="headingSuppliers">

                                    <div class="accordion-body">

                                        @foreach ($suppliers as $supplier)
                                            <x-forms.checkbox name="supplier[]" label="{{ $supplier->name }}"
                                                value="{{ $supplier->id }}" :id="'supplier-' . $supplier->id" :checked="in_array($supplier->id, request('supplier', []))" />
                                        @endforeach

                                    </div>

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <div class="accordion-item">

                                <h2 class="accordion-header" id="headingStatus">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseStatus" aria-expanded="false"
                                        aria-controls="collapseStatus">
                                        Status
                                    </button>

                                </h2>

                                <div id="collapseStatus" class="accordion-collapse collapse"
                                    aria-labelledby="headingStatus">

                                    <div class="accordion-body">

                                        @foreach ($statuses as $status)
                                            <x-forms.checkbox name="status[]" label="{{ $status->name }}"
                                                value="{{ $status->id }}" :id="'status-' . $status->id" :checked="in_array($status->id, request('status', []))" />
                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between gap-2 mt-3">

                            <a href="{{ url()->current() }}" class="btn btn-sm btn-light">
                                Limpar
                            </a>

                            <x-buttons.button type="submit" color="primary" label="Aplicar" class="btn-sm" />

                        </div>

                    </x-forms.form>

                </x-slot:sidebar>

            </x-layout.admin.crud.listing>
        @else
            <h1 class="text-center text-danger">Sem registros de Produtos</h1>
        @endif




        {{-- Modal: Novo Produto --}}
        <div class="modal fade product-create-modal" id="createProductModal" tabindex="-1"
            aria-labelledby="createProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">

                    <div class="modal-header">

                        <h2 class="modal-title" id="createProductModalLabel">
                            Novo Produto
                        </h2>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

                    </div>
                    <div class="modal-body">
                        <x-forms.form action="{{ route('admin.products.store') }}" enctype="multipart/form-data"
                            id="create-product-form">



                            {{-- IMAGEM / INFORMAÇÕES PRINCIPAIS --}}

                            <div class="product-create-main">

                                <div class="product-create-fields">

                                    <x-forms.input type="text" name="name" label="Nome:" :value="old('name')" />

                                    <x-forms.input type="number" name="price" label="Preço de custo:" :value="old('price')"
                                        step="0.01" min="0" />

                                    <x-forms.select name="brand_id" label="Marca:" :options="$brands->pluck('name', 'id')->toArray()"
                                        :selected="old('brand_id')" />

                                </div>

                                <div class="product-create-image">

                                    <label class="product-create-image-label" for="create-input-image">
                                        <div class="product-create-image-preview">
                                            <x-icons.camera />
                                        </div>
                                    </label>

                                    <input class="product-create-image-input" type="file" name="image"
                                        id="create-input-image" accept="image/*">

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <div class="product-create-section">

                                <h3>Status</h3>

                                <div class="product-status-options">

                                    @foreach ($statuses as $status)
                                        <label class="product-status-option">

                                            <input type="radio" name="status_id" value="{{ $status->id }}"
                                                @checked(old('status_id') == $status->id || (old('status_id') === null && $status->is_default))>

                                            <span>
                                                {{ $status->name }}
                                            </span>

                                        </label>
                                    @endforeach

                                </div>

                            </div>


                            {{-- CATEGORIAS --}}

                            <div class="product-create-section">

                                <h3 class="section-title">
                                    Categorias
                                </h3>

                                <div class="product-create-categories">

                                    @foreach ($categories as $parent)
                                        <div class="product-create-category">

                                            <div class="product-create-category-parent">
                                                {{ $parent->name }}
                                            </div>

                                            @forelse ($parent->children as $child)
                                                <x-forms.checkbox :name="'categories[]'" :label="$child->name" :value="$child->id"
                                                    :id="'category-' . $child->id" />

                                            @empty

                                                <small class="text-muted">
                                                    Sem subcategorias
                                                </small>
                                            @endforelse

                                        </div>
                                    @endforeach

                                </div>

                            </div>


                            {{-- COLEÇÕES --}}

                            <div class="product-create-section">

                                <h3 class="section-title">
                                    Coleções
                                </h3>

                                <div class="product-create-collections">

                                    @foreach ($collections as $collection)
                                        <x-forms.checkbox name="collections[]" :label="$collection->name" :value="$collection->id"
                                            :id="'collection-' . $collection->id" />
                                    @endforeach

                                </div>

                            </div>
                        </x-forms.form>
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <x-buttons.button type="submit" color="success" icon="check" label="Salvar" />

                    </div>



                </div>

            </div>
        </div>

    </x-layout.admin.page>

@endsection
