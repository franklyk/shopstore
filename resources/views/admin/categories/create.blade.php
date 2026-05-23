@extends('layouts.admin')

@section('title', 'Nova Categoria')

@section('content')

    <x-card title="Nova Categoria">
        <x-admin.forms.form action="{{ route('admin.categories.store') }}" method="POST">
            <x-admin.forms.row>
                <x-admin.forms.input type="text" name="name" label="Nome" />
            </x-admin.forms.row>

            <x-admin.forms.row>
                <x-admin.forms.input type="text" name="slug" label="Slug" />
            </x-admin.forms.row>

            <x-admin.forms.row>
                <x-admin.forms.input type="text" name="stock" label="Estoque" />
            </x-admin.forms.row>

            <x-admin.forms.row>
                <x-admin.forms.checkbox name="is_active" value="1" id="is_active" label="Categoria ativa" />
            </x-admin.forms.row>


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

        </x-admin.forms.form>
    </x-card>
@endsection
