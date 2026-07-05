@extends('layouts.admin')

@section('title', 'Produtos')

@section('admin')
    <div class="listing page-container">

        <x-ui.page-header title="Produtos Cadastrados" description="Listagem dos produtos da loja">

            <x-slot:actions>

                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Produtos']]" />

                <div class="d-flex gap-2">

                    <div class="dropdown">

                        <x-forms.form method="GET">

                            <ul class="dropdown-menu p-2">

                                {{-- BRANDS --}}
                                <li class="px-2 fw-bold">Marcas</li>

                                @foreach ($brands as $brand)
                                    <li class="px-2">
                                        <x-forms.checkbox name="brand[]" label="{{ $brand->name }}"
                                            value="{{ $brand->id }}" :id="'brand-' . $brand->id" :checked="in_array($brand->id, request('brand', []))" />
                                    </li>
                                @endforeach

                                <hr>

                                {{-- SUPPLIERS --}}
                                <li class="px-2 fw-bold">Fornecedores</li>

                                @foreach ($suppliers as $supplier)
                                    <li class="px-2">
                                        <x-forms.checkbox name="supplier[]" label="{{ $supplier->name }}"
                                            value="{{ $supplier->id }}" :id="'supplier-' . $supplier->id" :checked="in_array($supplier->id, request('supplier', []))" />
                                    </li>
                                @endforeach

                                <hr>

                                {{-- STATUS --}}
                                <li class="px-2 fw-bold">Status</li>

                                @foreach ($statuses as $status)
                                    <li class="px-2">
                                        <x-forms.checkbox name="status[]" label="{{ $status->name }}"
                                            value="{{ $status->id }}" :id="'status-' . $status->id" :checked="in_array($status->id, request('status', []))" />
                                    </li>
                                @endforeach

                                <hr>

                                <li class="d-flex justify-content-between px-2">

                                    <a href="{{ url()->current() }}" class="btn btn-sm btn-light">
                                        Limpar
                                    </a>

                                    <x-buttons.button type="submit" color="primary" label="Aplicar" class="btn-sm" />

                                </li>

                            </ul>

                        </x-forms.form>

                    </div>

                    <x-buttons.button color="secondary" label="Filtros" icon="filter" data-bs-toggle="dropdown" />

                    <x-buttons.button href="{{ route('admin.products.create') }}" color="success" icon="plus"
                        label="Novo" />

                </div>

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light shadow">

            @if (!empty($products))
                <table class="table align-middle table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-light bg-primary">IMAGEM</th>
                            <th scope="col" class="text-light bg-primary">CÓDIGO</th>
                            <th scope="col" class="text-light bg-primary">NOME</th>
                            <th scope="col" class="text-light bg-primary">MARCA</th>
                            <th scope="col" class="text-light bg-primary">FORNECEDOR</th>
                            <th scope="col" class="text-light bg-primary">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr scope="row" class="clickable-row"
                                data-href="{{ route('admin.products.show', $product) }}">
                                <td class="table-image">
                                    <div class="preview-image" id="preview-image">
                                        @if ($product->image)
                                            <img class="m-auto" src="{{ asset('storage/' . $product->image) }}" id="image">
                                        @else
                                            <div class="preview-placeholder d-flex justify-content-center">
                                                <x-icons.camera />
                                            </div>
                                        @endif
                                    </div>
                                    {{-- @if (!empty($product->image))
                                        <img src="{{ $product->image }}" alt="imagem">
                                    @else
                                        <img src="https://placehold.co/50x50" alt="imagem">
                                    @endif --}}
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->name }} </td>
                                <td>{{ $product->brand?->name }}</td>
                                <td>{{ $product->suppliers->pluck('name')->join(', ') }}</td>

                                <td>
                                    <span class="badge text-bg-{{ $product->status->color }}">{{ $product->status->name }}
                                    </span>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="text-center">Sem registros de Produtos</h1>
            @endif

            <div class="my-5">
                {{ $products->links() }}
            </div>
        </div>


    </div>

@endsection
