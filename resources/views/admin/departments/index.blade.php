@extends('layouts.admin')

@section('title', 'Departamentos')

@section('layout-admin')

    <x-layout.admin.page>

        <x-slot:header>

            <x-ui.page-header title="Departamentos">

                <x-slot:actions>

                    <x-ui.breadcrumbs
                        :items="[
                            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                            ['label' => 'Departamentos'],
                        ]"
                    />

                    <div class="d-flex gap-2">

                        @can('create departments')

                            <x-buttons.create
                                label="Novo"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-create"
                            />

                        @endcan

                    </div>

                </x-slot:actions>

            </x-ui.page-header>

        </x-slot:header>


        @if ($departments->count())

            <div class="listing">

                <div class="listing-content">

                    @include('admin.departments.partials.listing', [
                        'departments' => $departments,
                    ])

                </div>

                <aside class="listing-sidebar">

                    <div class="listing-per-page">

                        <select
                            name="per_page"
                            id="per-page"
                            class="form-select"
                        >

                            @foreach ([10, 15, 25, 50, 100] as $option)

                                <option
                                    value="{{ $option }}"
                                    @selected(request('per_page', 15) == $option)
                                >
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

                            <x-forms.search
                                name="search"
                                id="search"
                                placeholder="Pesquisar"
                            />

                        </div>


                        {{-- STATUS --}}

                        <div
                            class="accordion"
                            data-filter="filtered"
                        >

                            <div class="accordion-header">
                                Status
                            </div>

                            <div class="accordion-body">

                                @foreach ($statuses as $status)

                                    <x-forms.radio
                                        name="status"
                                        label="{{ $status->name }}"
                                        value="{{ $status->id }}"
                                        :id="'status-' . $status->id"
                                        :checked="(string) request('status') === (string) $status->id"
                                    />

                                @endforeach

                            </div>

                        </div>

                    </x-forms.form>

                </aside>

            </div>

        @else

            <h1 class="text-center text-danger">
                Sem registros de Departamentos
            </h1>

        @endif


        {{-- Modal: Novo Departamento --}}

        @can('create departments')

            <x-modal.create :action="route('admin.hr.departments.store')">

                <div class="modal-container">

                    <div class="modal-main">

                        <div class="modal-fields">

                            <x-forms.input
                                type="text"
                                name="name"
                                label="Nome:"
                                :value="old('name')"
                            />

                            <x-forms.input
                                type="text"
                                name="slug"
                                label="Slug:"
                                :value="old('slug')"
                            />

                            <x-forms.textarea
                                name="description"
                                label="Descrição:"
                            >{{ old('description') }}</x-forms.textarea>

                            <x-buttons.status
                                :statuses="$statuses"
                                :status-id="old('status_id')"
                            />

                        </div>

                    </div>

                </div>

            </x-modal.create>

        @endcan

    </x-layout.admin.page>

@endsection
