@extends('layouts.admin')

@section('title', 'Editar Categoria')

@section('content')

<div class="card">

    <div class="card-header">

        <div class="card-title">
            <h2>Editar Categoria</h2>
        </div>

    </div>

    <div class="card-body">

        <form action="{{ route('categories.update', $category) }}"
              method="POST"
              id="edit-form">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label for="name" class="form-label">

                    <strong>Nome</strong>

                </label>

                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name"
                       name="name"
                       value="{{ old('name', $category->name) }}">

                @error('name')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="mb-3">

                <label for="slug" class="form-label">

                    <strong>Slug</strong>

                </label>

                <input type="text"
                       class="form-control @error('slug') is-invalid @enderror"
                       id="slug"
                       name="slug"
                       value="{{ old('slug', $category->slug) }}">

                @error('slug')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="mb-3">

                <label for="parent_id" class="form-label">

                    <strong>Categoria Pai</strong>

                </label>

                <select name="parent_id"
                        id="parent_id"
                        class="form-select @error('parent_id') is-invalid @enderror">

                    <option value="">
                        Categoria Principal
                    </option>

                    @foreach($categories as $parent)

                        <option value="{{ $parent->id }}"
                            @selected(old('parent_id', $category->parent_id) == $parent->id)>

                            {{ $parent->name }}

                        </option>

                    @endforeach

                </select>

                @error('parent_id')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="form-check">

                <input type="hidden"
                       name="is_active"
                       value="0">

                <input class="form-check-input"
                       type="checkbox"
                       id="is_active"
                       name="is_active"
                       value="1"
                       @checked(old('is_active', $category->is_active))>

                <label class="form-check-label" for="is_active">

                    Categoria ativa

                </label>

            </div>

        </form>

    </div>

    <div class="card-footer">

        @can('view categories')

            <a href="{{ route('categories.index') }}"
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

        <button type="submit"
                class="btn btn-sm btn-warning"
                form="edit-form">

            <strong>

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="20"
                     height="20"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M20 6L9 17l-5-5" />

                </svg>

                Salvar

            </strong>

        </button>

    </div>

</div>

@endsection