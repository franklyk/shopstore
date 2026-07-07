@extends('layouts.admin')

@section('title', 'Detalhe do Fornecedor')

@section('admin')
    <div class="container-fluid">

        <x-ui.page-header title="Detalhes do Fornecedor" description="Visualize todos os dados do fornecedor.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Fornecedores', 'url' => route('admin.suppliers.index')],
                    ['label' => 'Visualizar'],
                ]" />

                <div class="container-buttons">

                    @can('view suppliers')
                        <x-buttons.button
                            href="{{ route('admin.suppliers.index') }}"
                            color="secondary"
                            icon="return"
                            label="Voltar"
                        />
                    @endcan

                    @can('edit suppliers')
                        <x-buttons.button
                            href="{{ route('admin.suppliers.edit', $supplier) }}"
                            color="edit"
                            icon="edit"
                            label="Editar"
                        />
                    @endcan

                    @can('delete suppliers')
                        <x-buttons.button
                            color="danger"
                            icon="trash"
                            label="Excluir"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $supplier->id }}"
                        />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-3 shadow">

            <dl class="desc-list">

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Nome</dt>
                <dt class="col-md-6 fw-bolder text-secondary fs-5">{{ $supplier->name }}</dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Slug</dt>
                <dt class="col-md-6 fw-bolder text-secondary fs-5">{{ $supplier->slug }}</dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Status</dt>
                <dt class="col-md-6 fw-bolder text-secondary fs-5">{{ $supplier->active ? 'Ativo' : 'Inativo' }}</dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Cadastrado em</dt>
                <dt class="col-md-6 fw-bolder text-secondary fs-5">{{ $supplier->created_at }}</dd>

                <dt class="col-md-6 fw-bolder text-secondary fs-5">Última atualização</dt>
                <dt class="col-md-6 fw-bolder text-secondary fs-5">{{ $supplier->updated_at }}</dd>

            </dl>

        </div>

    </div>

    @section('modals')
        @can('delete suppliers')
            <x-modal.delete
                :action="route('admin.suppliers.destroy', $supplier)"
                :id="$supplier->id"
                :name="$supplier->name"
            />
        @endcan
    @endsection

@endsection
