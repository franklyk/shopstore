@extends('layouts.admin')

@section('title', 'Novo Produto')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h2>Novo Produto</h2>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST" id="create-form">

            @csrf

            {{-- Nome --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            {{-- Descrição --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            {{-- Preço --}}
            <div class="mb-3">
                <label for="price" class="form-label">Preço</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>

            {{-- Estoque --}}
            <div class="mb-3">
                <label for="stock" class="form-label">Estoque</label>
                <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
            </div>

            {{-- CATEGORIAS --}}
            <div class="mb-3">
                <label class="form-label"><strong>Categorias</strong></label>

                <div class="border rounded p-3">

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">

                        @forelse($categories as $parent)
                            <div class="col">

                                <div class="p-2 border rounded h-100">

                                    {{-- PAI --}}
                                    <div class="fw-bold text-primary mb-2">
                                        {{ $parent->name }}
                                    </div>

                                    {{-- FILHAS --}}
                                    <div class="ms-2">

                                        @forelse($parent->children as $child)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="categories[]"
                                                       value="{{ $child->id }}"
                                                       id="cat_{{ $child->id }}">

                                                <label class="form-check-label" for="cat_{{ $child->id }}">
                                                    {{ $child->name }}
                                                </label>
                                            </div>
                                        @empty
                                            <small class="text-muted">Sem subcategorias</small>
                                        @endforelse

                                    </div>

                                </div>

                            </div>
                        @empty
                            <div class="col">
                                <p class="text-muted mb-0">Nenhuma categoria cadastrada.</p>
                            </div>
                        @endforelse

                    </div>

                </div>
            </div>

        </form>
    </div>

    <div class="card-footer">
        @can('view products')
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary ms-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                    <path d="M9 14L4 9l5-5" />
                    <path d="M20 20v-7a4 4 0 0 0-4-4H4" />

                </svg>
                Voltar
            </a>
        @endcan

        <button type="submit" class="btn btn-sm btn-success" form="create-form">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                <path d="M20 6L9 17l-5-5" />

            </svg>

            Cadastrar
        </button>
    </div>
</div>

@endsection