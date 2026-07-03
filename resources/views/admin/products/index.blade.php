@extends('layouts.admin')

@section('title', 'Produtos')

@section('admin')
    <div class="listing page-container">
        {{-- @dd($products) --}}
        <x-ui.page-header title="Produtos Cadastrados" description="Listagem dos produtos da loja">

            {{-- <div class="d-flex flex-column"> --}}
            <x-slot:actions>
                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Produtos']]" />
                <div class=" dropdown d-flex gap-2">

                    <x-forms.form method="GET" class="mb-4">
                        <ul class="dropdown-menu">
                            @foreach ($statuses as $status)
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <x-forms.checkbox name="status[]" label="{{ $status->name }}"
                                            value="{{ $status->id }}" :id="'status-' . $status->id" />
                                    </a>
                                </li>
                            @endforeach()
                            <x-buttons.button type="submit" color="primary" label="Aplicar" class="justify-self-end border"/>
                        </ul>
                    </x-forms.form>

                    <x-buttons.button href="" color="secondary" label="Filtrar" icon="filter"
                        data-bs-toggle="dropdown" aria-expanded="false" />

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
                            <th scope="col" class="text-light bg-primary">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr scope="row" class="clickable-row"
                                data-href="{{ route('admin.products.show', $product) }}">
                                <td class="table-image">
                                    @if (!empty($product->image))
                                        <img src="{{ $product->image }}" alt="imagem">
                                    @else
                                        <img src="https://placehold.co/50x50" alt="imagem">
                                    @endif
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->name }} </td>

                                <td>
                                    <span
                                        class="badge text-bg-{{ $product->status->color }}">{{ $product->status->name }}</span>
                                    {{-- @if ($product->is_active == 1)
                                        <span class="badge text-bg-success">Ativo</span>
                                    @else
                                        <span class="badge text-bg-success">Inativo</span>
                                    @endif --}}

                                </td>
                                {{-- <td data-field="center">R$ {{ $product->price }}</td> --}}
                                {{-- <td data-field="center">{{ $product->stocks->first()?->quantity }}</td> --}}
                                {{-- <td>
                            <x-buttons.button href="{{ route('admin.products.show', $product) }}" color="view" icon="eye" />
                        </td> --}}
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
