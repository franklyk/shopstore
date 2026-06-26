@extends('layouts.admin')

@section('title', 'Detalhes da Categoria')

@section('admin')
    <div class="page-container">
        <x-ui.page-header title="Detalhes do Produto" description="Visualize todos o detalhes do produto.">

            <x-slot:actions>
                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Categorias', 'url' => route('admin.categories.index')],
                    ['label' => 'Visualizar'],
                ]" />
                <div class="container-buttons">
                    @can('view products')
                        <x-buttons.button href="{{ route('admin.categories.index') }}" color="return" icon="return"
                            label="Voltar" />
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

                    @if ($category->parent)
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

                    @if ($category->active)
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
            @if ($category->children->count())

                <hr>

                <h5>Subcategorias</h5>

                <ul>

                    @foreach ($category->children as $child)
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
    @can('delete categories')
        <x-modal.delete :action="route('admin.categories.destroy', $category)" :id="$category->id" :name="$category->name" />
    @endcan
@endsection

@endsection
