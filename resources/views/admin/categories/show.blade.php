@extends('layouts.admin')

@section('title', 'Detalhes da Categoria')

@section('admin')
    <div class="container-fluid">
        <x-ui.page-header title="Detalhes do Produto" description="Visualize todos o detalhes do produto.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Categorias', 'url' => route('admin.categories.index')],
                    ['label' => 'Visualizar'],
                ]" />
                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.categories.index') }}" color="return" icon="return" label="Voltar" />
                    @endcan

                    @can('edit products')
                        <x-buttons.button href="{{ route('admin.categories.edit', $category) }}" color="edit" icon="edit"
                            label="Editar" />
                    @endcan

                    @can('delete products')
                        <x-buttons.button color="delete" icon="trash" label="Excluir" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $category->id }} " />
                    @endcan

                </div>
            </x-slot:actions>

        </x-ui.page-header>

        <div class="card-vs">

            <dl class="desc-list">
                <dt>
                Nome
            </dt>

            <dd>
                {{ $category->name }}
            </dd>

            <dt>
                Slug
            </dt>

            <dd>
                {{ $category->slug }}
            </dd>

            <dt>
                Categoria Pai
            </dt>

            <dd>

                @if($category->parent)

                    {{ $category->parent->name }}

                @else

                    <span class="badge bg-secondary">
                        Principal
                    </span>

                @endif

            </dd>

            <dt>
                Status
            </dt>

            <dd>

                @if($category->is_active)

                    <span class="badge bg-success">
                        Ativa
                    </span>

                @else

                    <span class="badge bg-danger">
                        Inativa
                    </span>

                @endif

            </dd>

            <dt>
                UUID
            </dt>

            <dd>
                <code>{{ $category->uuid }}</code>
            </dd>

            <dt>
                Cadastrado em
            </dt>

            <dd>
                {{ $category->created_at->format('d/m/Y H:i') }}
            </dd>

            <dt>
                Última atualização
            </dt>

            <dd>
                {{ $category->updated_at->format('d/m/Y H:i') }}
            </dd>
            </dl>
            @if($category->children->count())

            <hr>

            <h5>
                Subcategorias
            </h5>

            <ul>

                @foreach($category->children as $child)

                    <li>

                        {{ $child->name }}

                        <span>
                            Subcategoria
                        </span>

                    </li>

                @endforeach

            </ul>

        @endif
        </div>
    </div>

    @section('modals')
        @can('delete products')
            <x-modal.delete :action="route('admin.products.destroy', $category)" :id="$category->id" :name="$category->name" />
        @endcan
    @endsection

@endsection


@extends('layouts.admin')

@section('title', 'Detalhes da Categoria')

@section('admin')

<div class="card">

    <div class="card-header">

        <div class="card-title">
            <h2>Detalhes da Categoria</h2>
        </div>

    </div>

    <div class="card-body">

        <dl class="row">

            <dt>
                Nome
            </dt>

            <dd>
                {{ $category->name }}
            </dd>

            <dt>
                Slug
            </dt>

            <dd>
                {{ $category->slug }}
            </dd>

            <dt>
                Categoria Pai
            </dt>

            <dd>

                @if($category->parent)

                    {{ $category->parent->name }}

                @else

                    <span class="badge bg-secondary">
                        Principal
                    </span>

                @endif

            </dd>

            <dt>
                Status
            </dt>

            <dd>

                @if($category->is_active)

                    <span class="badge bg-success">
                        Ativa
                    </span>

                @else

                    <span class="badge bg-danger">
                        Inativa
                    </span>

                @endif

            </dd>

            <dt>
                UUID
            </dt>

            <dd>
                <code>{{ $category->uuid }}</code>
            </dd>

            <dt>
                Cadastrado em
            </dt>

            <dd>
                {{ $category->created_at->format('d/m/Y H:i') }}
            </dd>

            <dt>
                Última atualização
            </dt>

            <dd>
                {{ $category->updated_at->format('d/m/Y H:i') }}
            </dd>

        </dl>

        @if($category->children->count())

            <hr>

            <h5>
                Subcategorias
            </h5>

            <ul>

                @foreach($category->children as $child)

                    <li>

                        {{ $child->name }}

                        <span>
                            Subcategoria
                        </span>

                    </li>

                @endforeach

            </ul>

        @endif

    </div>

    <div class="card-footer">

        @can('view categories')

            <a href="{{ route('admin.categories.index') }}"
               class="btn btn-sm btn-secondary">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="20"
                     height="20"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M9 14L4 9l5-5" />
                    <path d="M20 20v-7a4 4 0 0 0-4-4H4" />

                </svg>

                Voltar

            </a>

        @endcan

        @can('edit categories')

            <a href="{{ route('admin.categories.edit', $category) }}"
               class="btn btn-sm btn-warning">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="20"
                     height="20"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M12 20h9" />
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />

                </svg>

                Editar

            </a>

        @endcan

    </div>

</div>

@endsection
