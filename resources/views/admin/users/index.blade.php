@extends('layouts.admin')

@section('title', 'Usuários')

@section('layout-admin')

    <x-layout.admin.page>

        <x-slot:header>

            <x-ui.page-header title="Usuários Cadastrados">

                <x-slot:actions>

                    <x-ui.breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Usuários']]" />

                    <div class="d-flex gap-2">

                        <x-buttons.create label="Novo" data-bs-toggle="modal" data-bs-target="#modal-create" />

                    </div>

                </x-slot:actions>

            </x-ui.page-header>

        </x-slot:header>

        @if (!empty($users))

            <div class="listing">

                <div class="listing-content">

                    @include('admin.users.partials.listing', [
                        'users' => $users,
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

                                            <x-forms.radio name="sort_name" value="asc" label="A → Z"
                                                id="sort-name-asc" :checked="request('sort_name', 'asc') === 'asc'" />

                                            <x-forms.radio name="sort_name" value="desc" label="Z → A"
                                                id="sort-name-desc" :checked="request('sort_name') === 'desc'" />

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="accordion" data-filter="filtered">

                            <div class="accordion-item">

                                <h2 class="accordion-header" id="headingRoles">

                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseRoles" aria-expanded="false"
                                        aria-controls="collapseRoles">
                                        Cargos
                                    </button>

                                </h2>

                                <div id="collapseRoles" class="accordion-collapse collapse"
                                    aria-labelledby="headingRoles">

                                    <div class="accordion-body">

                                        @foreach ($roles as $role)
                                            <x-forms.radio name="role" label="{{ $role->name }}"
                                                value="{{ $role->id }}" :id="'status-' . $role->id" :checked="(string) request('role') === (string) $role->id" />
                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        </div>

                    </x-forms.form>

                </aside>

            </div>
        @else
            <h1 class="text-center text-danger">
                Sem registros de Usuários
            </h1>

        @endif

    </x-layout.admin.page>

@endsection
