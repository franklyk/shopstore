@extends('layouts.admin')

@section('title', 'Detalhes da Categoria')

@section('admin')
    <div class="page-container">
        <x-ui.page-header title="Detalhes da Categoria" description="Visualize todos o detalhes da categoria.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Categorias', 'url' => route('admin.categories.index')],
                    ['label' => 'Visualizar'],
                ]" />
                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.categories.index') }}" color="secondary" icon="return"
                            label="Voltar" />
                    @endcan

                    @can('edit products')
                        <x-buttons.button href="{{ route('admin.categories.edit', $category) }}" color="warning" icon="edit"
                            label="Editar" />
                    @endcan

                    @can('delete products')
                        <x-buttons.button color="danger" icon="trash" label="Excluir" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $category->id }} " />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light">

            <div class="card p-3 shadow">
                <dl class="row">
                    <dt class="col-md-6 fw-bolder text-secondary fs-5">Nome</dt>
                    <dd class="col-md-6 fw-light text-danger">{{ $category->name }}</dd>

                    <dt class="col-md-6 fw-bolder text-secondary fs-5">Slug</dt>
                    <dd class="col-md-6 fw-light text-danger">{{ $category->slug }}</dd>

                    <dt class="col-md-6 fw-bolder text-secondary fs-5">Categoria Pai</dt>
                    <dd class="col-md-6 fw-light text-danger">
                        @if ($category->parent)
                            {{ $category->parent->name }}
                        @else
                            <span class="badge bg-secondary">
                                Principal
                            </span>
                        @endif
                    </dd>

                    <dt class="col-md-6 fw-bolder text-secondary fs-5">Status</dt>
                    <dd class="col-md-6 fw-light text-danger">
                        <span class="badge text-bg-{{ $category->status->color }}">
                            {{ $category->status->name }}
                        </span>
                    </dd>
                    <dt class="col-md-6 fw-bolder text-secondary fs-5">UUID</dt>
                    <dd class="col-md-6 fw-light text-danger"><code>{{ $category->uuid }}</code></dd>

                    <dt class="col-md-6 fw-bolder text-secondary fs-5">Cadastrado em</dt>
                    <dd class="col-md-6 fw-light text-danger">{{ $category->created_at->format('d/m/Y H:i') }}</dd>

                    <dt class="col-md-6 fw-bolder text-secondary fs-5">Última atualização</dt>
                    <dd class="col-md-6 fw-light text-danger">{{ $category->updated_at->format('d/m/Y H:i') }}</dd>

                </dl>
            </div>
            <hr>
            @if ($category->children->count())

                <div class="card p-3 shadow">
                    <h5 class="section-title text-center">Subcategorias</h5>

                    <ul class="text-secondary">
                        @foreach ($category->children as $child)
                            <li>
                                {{ $child->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <h1 class="text-center ">Não existem subcategorias</h1>
            @endif
        </div>
    </div>

@section('modals')
    @can('delete categories')
        <x-modal.delete :action="route('admin.categories.destroy', $category)" :id="$category->id" :name="$category->name" />
    @endcan
@endsection

@endsection
