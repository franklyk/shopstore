@extends('layouts.profile')

@section('title', 'Editar Perfil')

@section('profile')

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header d-flex align-items-center">

                    <div class="card-title">
                        <h2>Editar Perfil</h2>
                    </div>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('profile.update') }}"
                        method="POST"
                        id="edit-profile-form">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label for="name" class="form-label">
                                <strong>Nome</strong>
                            </label>

                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name', $user->name) }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-3">

                            <label for="email" class="form-label">
                                <strong>E-mail</strong>
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                value="{{ $user->email }}"
                                disabled>

                            <div class="form-text">
                                O e-mail não pode ser alterado neste momento.
                            </div>

                        </div>

                    </form>

                </div>

                <div class="card-footer d-flex align-items-center gap-1">

                    <x-buttons.button href="{{ route('profile.show') }}" color="secondary" icon="return" label="Voltar" />

                    <x-buttons.button type="submit" color="warning" icon="check" form="edit-profile-form"
                        label="Salvar" />

                </div>

            </div>

        </div>

    </div>

@endsection
