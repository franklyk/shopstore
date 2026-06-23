@extends('layouts.admin')

@section('title', 'Editar Categoria')

@section('admin')

    <x-card title="Editar Categoria">

        <x-forms.form action="{{ route('admin.categories.update', $category->id) }}" method="PUT">

            <x-forms.row>
                <x-forms.input type="text" name="name" label="Nome" value="{{ $category->name }}" />
            </x-forms.row>

            <x-forms.row>
                <x-forms.input type="text" name="slug" label="Slug" value="{{ $category->slug }}" />
            </x-forms.row>

            <x-forms.row>
                <x-forms.checkbox name="is_active" value="1" id="is_active" label="Categoria ativa" />
            </x-forms.row>


            <div class="mb-3">

                <p for="parent_id" class="form-label">
                    <strong>Categoria Pai</strong>
                </p>

                <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror">

                    <option value="">
                        Categoria Principal
                    </option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('parent_id') == $category->id)>

                            {{ $category->name }}

                        </option>
                    @endforeach

                </select>
            </div>

            @can('view categories')
                <x-buttons.button href="{{ route('admin.categories.index') }}" color="secondary" icon="return" label="Voltar" />
            @endcan

            <x-buttons.button type="submit" color="success" icon="check" label="Cadastrar" />

        </x-forms.form>
    </x-card>

@endsection
