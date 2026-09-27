@extends('layouts.admin')

@section('title', 'Detalhe do Departamento')

@section('layout-admin')

    <x-layout.admin.page>

        <x-slot:header>

            <x-ui.page-header title="Detalhes do Departamento">

                <x-slot:actions>

                    <x-ui.breadcrumbs
                        :items="[
                            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                            ['label' => 'Departamentos', 'url' => route('admin.hr.departments.index')],
                            ['label' => 'Visualizar'],
                        ]"
                    />

                    <div class="container-buttons">

                        @can('view departments')

                            <x-buttons.button
                                href="{{ route('admin.hr.departments.index') }}"
                                color="secondary"
                                icon="return"
                                label="Voltar"
                            />

                        @endcan

                    </div>

                </x-slot:actions>

            </x-ui.page-header>

        </x-slot:header>


        {{-- Dados do Departamento --}}

        <div class="card">

            <div class="details">

                <dl class="details-list">

                    <dt class="details-label">
                        Nome
                    </dt>

                    <dd class="details-value">
                        {{ $department->name }}
                    </dd>


                    <dt class="details-label">
                        Slug
                    </dt>

                    <dd class="details-value">
                        {{ $department->slug }}
                    </dd>


                    <dt class="details-label">
                        Descrição
                    </dt>

                    <dd class="details-value">
                        {{ $department->description ?: '—' }}
                    </dd>


                    <dt class="details-label">
                        Status
                    </dt>

                    <dd class="details-value">

                        <span class="badge text-bg-{{ $department->status->color }}">

                            {{ $department->status->name }}

                        </span>

                    </dd>


                    <dt class="details-label">
                        Cargos
                    </dt>

                    <dd class="details-value">
                        {{ $department->positions->count() }}
                    </dd>


                    <dt class="details-label">
                        Cadastrado em
                    </dt>

                    <dd class="details-value">
                        {{ $department->created_at->format('d/m/Y H\:i') }}
                    </dd>


                    <dt class="details-label">
                        Última atualização em
                    </dt>

                    <dd class="details-value">
                        {{ $department->updated_at->format('d/m/Y H\:i') }}
                    </dd>

                </dl>

            </div>

        </div>


        {{-- Cargos do Departamento --}}

        <div class="card mt-4">

            <div class="details">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h2 class="section-title mb-0">
                        Cargos
                    </h2>

                </div>


                @if ($department->positions->isNotEmpty())

                    <div class="table-container">

                        <x-ui.table>

                            <x-slot:table>

                                <thead>

                                    <tr>

                                        <th scope="col">
                                            NOME
                                        </th>

                                        <th scope="col">
                                            SLUG
                                        </th>

                                        <th scope="col">
                                            FUNCIONÁRIOS
                                        </th>

                                        <th scope="col">
                                            STATUS
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($department->positions as $position)

                                        <tr
                                            scope="row"
                                            class="clickable-row"
                                            data-href="#"
                                        >

                                            <td>
                                                {{ $position->name }}
                                            </td>

                                            <td>
                                                {{ $position->slug }}
                                            </td>

                                            <td>
                                                {{ $position->users_count }}
                                            </td>

                                            <td>

                                                <span class="badge text-bg-{{ $position->status->color }}">

                                                    {{ $position->status->name }}

                                                </span>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </x-slot:table>

                        </x-ui.table>

                    </div>

                @else

                    <p class="text-muted mb-0">
                        Nenhum cargo cadastrado neste departamento.
                    </p>

                @endif

            </div>

        </div>

    </x-layout.admin.page>

@endsection
