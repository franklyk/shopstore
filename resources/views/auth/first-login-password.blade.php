
@extends('layouts.admin')

@section('layout-admin')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h4 mb-3">Alteração obrigatória de senha</h1>

                    <p class="text-muted mb-4">
                        Por segurança, altere sua senha provisória
                        antes de continuar utilizando o ShopStore.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('password.first-login.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">
                                Senha provisória atual
                            </label>

                            <input
                                type="password"
                                name="current_password"
                                id="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                autocomplete="current-password"
                                required
                                autofocus
                            >

                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Nova senha
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                minlength="12"
                                autocomplete="new-password"
                                required
                            >

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="form-text">
                                A senha deve ter pelo menos 12 caracteres.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                Confirmar nova senha
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                minlength="12"
                                autocomplete="new-password"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Alterar senha
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

