@extends('layouts.admin')

@section('title', 'Produtos')

@section('layout-admin')

    <x-layout.admin.page>
        <x-slot:header>
            <x-ui.page-header title="Produtos Cadastrados">

                <x-slot:actions>

                    <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Produtos']]" />

                    <div class="d-flex gap-2">

                        <x-buttons.button href="{{ route('admin.products.create') }}" color="success" icon="plus"
                            label="Novo" />

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

    </x-layout.admin.page>

@endsection
