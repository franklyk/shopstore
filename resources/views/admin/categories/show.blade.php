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

            <dt class="col-sm-3">
                Nome
            </dt>

            <dd class="col-sm-9">
                {{ $category->name }}
            </dd>

            <dt class="col-sm-3">
                Slug
            </dt>

            <dd class="col-sm-9">
                {{ $category->slug }}
            </dd>

            <dt class="col-sm-3">
                Categoria Pai
            </dt>

            <dd class="col-sm-9">

                @if($category->parent)

                    {{ $category->parent->name }}

                @else

                    <span class="badge bg-secondary">
                        Principal
                    </span>

                @endif

            </dd>

            <dt class="col-sm-3">
                Status
            </dt>

            <dd class="col-sm-9">

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

            <dt class="col-sm-3">
                UUID
            </dt>

            <dd class="col-sm-9">
                <code>{{ $category->uuid }}</code>
            </dd>

            <dt class="col-sm-3">
                Cadastrado em
            </dt>

            <dd class="col-sm-9">
                {{ $category->created_at->format('d/m/Y H:i') }}
            </dd>

            <dt class="col-sm-3">
                Última atualização
            </dt>

            <dd class="col-sm-9">
                {{ $category->updated_at->format('d/m/Y H:i') }}
            </dd>

        </dl>

        @if($category->children->count())

            <hr>

            <h5 class="mb-3">
                Subcategorias
            </h5>

            <ul class="list-group">

                @foreach($category->children as $child)

                    <li class="list-group-item d-flex justify-content-between align-items-center">

                        {{ $child->name }}

                        <span class="badge bg-primary">
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
