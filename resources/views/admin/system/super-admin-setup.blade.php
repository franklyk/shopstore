
@extends('layouts.admin')

@section('layout-admin')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h4 mb-2">Configuração inicial</h1>

                    <p class="text-muted mb-4">
                        Cadastre a conta Super Admin que será responsável
                        pela administração operacional do ShopStore.
                    </p>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('admin.system.super-admin.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Nome completo
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                maxlength="255"
                                autocomplete="name"
                                required
                                autofocus
                            >

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                E-mail
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                maxlength="255"
                                autocomplete="email"
                                required
                            >

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Senha provisória
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                autocomplete="new-password"
                                minlength="12"
                                required
                            >

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="form-text">
                                Use pelo menos 12 caracteres. O Super Admin
                                deverá alterar essa senha no primeiro acesso.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                Confirme a senha provisória
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                autocomplete="new-password"
                                minlength="12"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Cadastrar Super Admin
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
