@extends('layouts.profile')

@section('title', 'Editar Endereço')

@section('profile')

    <div class="card">

        <div class="card-header d-flex align-items-center">
            <div class="card-title">
                <h2>Editar Endereço</h2>
            </div>
        </div>

        <div class="card-body">

            <form
                action="{{ route('profile.addresses.update', $address) }}"
                method="POST"
                id="edit-form">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Identificação
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="{{ old('name', $address->name) }}">
                </div>

                <div class="mb-3">
                    <label for="cep" class="form-label">
                        CEP
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="cep"
                        name="cep"
                        value="{{ old('cep', $address->cep) }}">
                </div>

                <div class="mb-3">
                    <label for="street" class="form-label">
                        Rua
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="street"
                        name="street"
                        value="{{ old('street', $address->street) }}">
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">
                        Número
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="number"
                        name="number"
                        value="{{ old('number', $address->number) }}">
                </div>

                <div class="mb-3">
                    <label for="complement" class="form-label">
                        Complemento
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="complement"
                        name="complement"
                        value="{{ old('complement', $address->complement) }}">
                </div>

                <div class="mb-3">
                    <label for="district" class="form-label">
                        Bairro
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="district"
                        name="district"
                        value="{{ old('district', $address->district) }}">
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">
                        Cidade
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="city"
                        name="city"
                        value="{{ old('city', $address->city) }}">
                </div>

                <div class="mb-3">
                    <label for="state" class="form-label">
                        Estado
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="state"
                        name="state"
                        value="{{ old('state', $address->state) }}">
                </div>

                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="is_default"
                        name="is_default"
                        value="1"
                        {{ old('is_default', $address->is_default) ? 'checked' : '' }}>

                    <label
                        class="form-check-label"
                        for="is_default">
                        Definir como endereço padrão
                    </label>
                </div>

            </form>

        </div>

        <div class="card-footer">

            <a
                href="{{ route('profile.addresses.index') }}"
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

            <button
                type="submit"
                class="btn btn-sm btn-success"
                form="edit-form">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path d="M20 6L9 17l-5-5" />

                </svg>

                Atualizar

            </button>

        </div>

    </div>

@endsection
