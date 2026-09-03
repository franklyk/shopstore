@extends('layouts.admin')

@section('title', 'Produtos')

@section('layout-admin')

    <x-layout.admin.page>
        <x-slot:header>
            <x-ui.page-header title="Produtos Cadastrados">

                <x-slot:actions>

                    <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Produtos']]" />

                    <div class="d-flex gap-2">

                        <x-buttons.create label="Novo" data-bs-toggle="modal" data-bs-target="#modal-create"/>

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
                            <th scope="col">COLEÇÃO</th>
                            <th scope="col">MARCA</th>
                            <th scope="col">FORNECEDOR</th>
                            <th scope="col">STATUS</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($products as $product)

                            <tr scope="row" class="clickable-row" data-href="{{ route('admin.products.show', $product) }}">

                                <td>{{ $product->sku }}</td>

                                <td>{{ $product->name }}</td>

                                <td>{{ $product->collections->first()?->name }}</td>

                                <td>{{ $product->brand?->name }}</td>

                                <td>
                                    {{ $product->suppliers->pluck('name')->join(', ') }}
                                </td>

                                <td>
                                    <span class="badge text-bg-{{ $product->status->color }}">
                                        {{ $product->status->name }}
                                    </span>
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


        {{-- ///////////////////////////////////////////////////////////////////////////////////////////////// --}}

        {{-- Modal: Novo Produto --}}

        {{-- ///////////////////////////////////////////////////////////////////////////////////////////////// --}}

        {{-- Modal: Novo Produto --}}


        <x-modal.create action="{{ route('admin.products.store') }}">

            <div class="modal-container">

                <div class="modal-create-main">

                    <div class="modal-fields">


                        <x-forms.input type="text" name="name" label="Produto:" :value="old('name')" />

                        <div class="auto-grid">
                            <x-forms.input type="number" name="price" label="Preço:" :value="old('price')" step="0.01"
                                min="0" />
                            <x-forms.select name="brand_id" label="Marca:" :options="$brands->pluck('name', 'id')->toArray()" :selected="old('brand_id')" />

                            <x-forms.select name="collection_id" label="Coleção:" :options="$collections->pluck('name', 'id')->toArray()" :selected="old('collection_id')" />

                            <x-forms.select name="supplier_id" label="Fornecedor:" :options="$suppliers->pluck('name', 'id')->toArray()" :selected="old('supplier_id')" />

                        </div>

                    </div>

                    <div class="div">
                        <div class="modal-image">

                            <label class="product-create-image-label modal-image-label" for="input-image">
                                <div class="modal-image-preview" id="preview-image">
                                    <x-icons.camera />
                                </div>
                            </label>

                            <input class="input-image" type="file" name="image" id="input-image" accept="image/*">

                        </div>

                        <x-buttons.status :statuses="$statuses" :status-id="old('status_id', $statuses->firstWhere('is_default', true)->id)" />


                    </div>

                </div>

                {{-- CATEGORIAS --}}

                <div class="modal-section">

                    <h3 class="section-title">
                        Categorias
                    </h3>

                    <div class="product-create-categories checkbox-groups">

                        @foreach ($categories as $parent)
                            <div class="product-create-category checkbox-options">

                                <div class="product-create-category-parent checkbox-options-parent ">
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

            </div>

        </x-modal.create>

    </x-layout.admin.page>

@endsection
