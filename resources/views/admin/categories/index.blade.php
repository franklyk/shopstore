@extends('layouts.admin')

@section('title', 'Categorias')

@section('admin')

    <x-layout.admin.crud.listing :links=$categories>
        <x-ui.page-header title="Categorias Cadastradas">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Categorias']]" />

                <div class="d-flex gap-2">

                    <div class="dropdown">

                        <x-forms.form method="GET">

                            <ul class="dropdown-menu p-2">


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

        @if (!empty($categories))
            <x-slot:table>
                <thead>
                    <tr>
                        <th scope="col" class="text-light bg-primary">COD</th>
                        <th scope="col" class="text-light bg-primary">Nome</th>
                        <th scope="col" class="text-light bg-primary">Categoria Pai</th>
                        <th scope="col" class="text-light bg-primary">Status</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr scope="row" class="clickable-row"
                            data-href="{{ route('admin.categories.show', $category) }}">

                            <th scope="row">
                                {{ $category->id }}
                            </th>

                            <td>
                                {{ $category->name }}
                            </td>

                            <td>

                                @if ($category->parent)
                                    <span class="text-secondary">
                                        {{ $category->parent->name }}
                                    </span>
                                @else
                                    <span class="text-secondary">
                                        Principal
                                    </span>
                                @endif

                            </td>

                            <td>
                                <span class="badge text-bg-{{ $category->status->color }}">{{ $category->status->name }}
                                </span>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </x-slot:table>
        @else
            <h1 class="text-center text-danger">Sem registros de Categorias</h1>
        @endif
    </x-layout.admin.crud.listing>

@endsection
