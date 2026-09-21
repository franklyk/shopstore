@extends('layouts.admin')

@section('title', 'Produtos')

@section('layout-admin')

    <x-layout.admin.page>
        <x-slot:header>
            <x-ui.page-header title="Produtos Cadastrados">

                <x-slot:actions>

                    <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Produtos']]" />

                    <div class="d-flex gap-2">

                        <x-buttons.create label="Novo" data-bs-toggle="modal" data-bs-target="#modal-create" />

                    </div>


                </x-slot:actions>

            </x-ui.page-header>

        </x-slot:header>

        @if (!empty($products))
            <div class="listing">
                <div class="listing-content">

                    @include('admin.products.partials.listing', [
                        'products' => $products,
                    ])

                </div>


                <aside class="listing-sidebar">



                    <div class="listing-per-page">



                        <select name="per_page" id="per-page" class="form-select">

                            @foreach ([10, 15, 25, 50, 100] as $option)
                                <option value="{{ $option }}" @selected(request('per_page', 15) == $option)>
                                    {{ $option }}
                                </option>
                            @endforeach

                        </select>

                        <label for="per-page">
                            Por página
                        </label>

                    </div>

                    <x-forms.form class="listing-filters">

                        <div class="listing-search">

                            <x-forms.search name="search" id="search" placeholder="Pesquisar" />

                        </div>

                        {{-- DATA DE CADASTRO --}}
                        <div class="accordion" data-filter="filtered">
                            <div class="accordion-item">

                                <h2 class="accordion-header" id="headingCreatedAt">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseCreatedAt" aria-expanded="false"
                                        aria-controls="collapseCreatedAt">
                                        Data de cadastro
                                    </button>

                                </h2>

                                <div id="collapseCreatedAt" class="accordion-collapse collapse"
                                    aria-labelledby="headingCreatedAt">

                                    <div class="accordion-body">

                                        <div class="listing-date-field">

                                            <label for="created-from" class="form-label">
                                                De
                                            </label>

                                            <input type="date" name="created_from" id="created-from"
                                                value="{{ request('created_from') }}" class="form-control">

                                        </div>

                                        <div class="listing-date-field">

                                            <label for="created-to" class="form-label">
                                                Até
                                            </label>

                                            <input type="date" name="created_to" id="created-to"
                                                value="{{ request('created_to') }}" class="form-control">

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                        {{-- ORDENAR POR --}}
                        <div class="accordion" data-filter="filtered">

                            <div class="accordion-item">

                                <h2 class="accordion-header" id="headingSort">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSort" aria-expanded="false" aria-controls="collapseSort">
                                        Ordenar por
                                    </button>

                                </h2>

                                <div id="collapseSort" class="accordion-collapse collapse" aria-labelledby="headingSort">

                                    <div class="accordion-body">

                                        <div class="sort-group">

                                            <div class="sort-group-title">
                                                Data
                                            </div>

                                            <x-forms.radio name="sort_date" value="newest" label="Mais recentes"
                                                id="sort-date-newest" :checked="request('sort_date', 'newest') === 'newest'" />

                                            <x-forms.radio name="sort_date" value="oldest" label="Mais antigos"
                                                id="sort-date-oldest" :checked="request('sort_date') === 'oldest'" />

                                        </div>

                                        <div class="sort-group">

                                            <div class="sort-group-title">
                                                Nome
                                            </div>

                                            <x-forms.radio name="sort_name" value="asc" label="A → Z" id="sort-name-asc"
                                                :checked="request('sort_name', 'asc') === 'asc'" />

                                            <x-forms.radio name="sort_name" value="desc" label="Z → A"
                                                id="sort-name-desc" :checked="request('sort_name') === 'desc'" />

                                        </div>

                                        <div class="sort-group">

                                            <div class="sort-group-title">
                                                Preço
                                            </div>

                                            <x-forms.radio name="sort_price" value="asc" label="Menor → Maior"
                                                id="sort-price-asc" :checked="request('sort_price', 'asc') === 'asc'" />

                                            <x-forms.radio name="sort_price" value="desc" label="Maior → Menor"
                                                id="sort-price-desc" :checked="request('sort_price') === 'desc'" />

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- STATUS --}}
                        <div class="accordion" data-filter="filtered">
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
                                            <x-forms.radio name="status" label="{{ $status->name }}"
                                                value="{{ $status->id }}" :id="'status-' . $status->id" :checked="(string) request('status') === (string) $status->id" />
                                        @endforeach

                                    </div>

                                </div>

                            </div>
                        </div>

                        {{-- BRANDS --}}
                        <div class="accordion" data-filter="filtered">

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
                        </div>

                        {{-- SUPPLIERS --}}
                        <div class="accordion" data-filter="filtered">
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
                        </div>



                    </x-forms.form>
                </aside>

            </div>
        @else
            <h1 class="text-center text-danger">Sem registros de Produtos</h1>
        @endif

        {{-- ///////////////////////////////////////////////////////////////////////////////////////////////// --}}

        {{-- Modal: Novo Produto --}}
        <x-modal.create action="{{ route('admin.products.store') }}">

            <div class="modal-container">

                <div class="modal-main">

                    <div class="modal-fields">


                        <x-forms.input type="text" name="name" label="Produto:" :value="old('name')" />

                        <div class="auto-grid">
                            <x-forms.input type="number" name="price" label="Preço:" :value="old('price')"
                                step="0.01" min="0" />
                            <x-forms.select name="brand_id" label="Marca:" :options="$brands->pluck('name', 'id')->toArray()" :selected="old('brand_id')" />

                            <x-forms.select name="collection_id" label="Coleção:" :options="$collections->pluck('name', 'id')->toArray()" :selected="old('collection_id')" />

                            <x-forms.select name="supplier_id" label="Fornecedor:" :options="$suppliers->pluck('name', 'id')->toArray()"
                                :selected="old('supplier_id')" />

                        </div>

                    </div>

                    <div class="div">

                        <div class="modal-image">

                            <label class="modal-image-label" for="input-image">

                                <div class="modal-image-preview" id="preview-image">

                                    <x-icons.camera />

                                </div>

                            </label>

                            <input class="input-image" type="file" name="image" id="input-image" accept="image/*"
                                data-preview="#preview-image">

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
