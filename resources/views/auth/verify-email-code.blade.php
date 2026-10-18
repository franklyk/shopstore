
@extends('layouts.admin')

@section('layout-admin')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h5 text-center mb-3">
                        Verificar e-mail
                    </h1>

                    <p class="text-muted small text-center mb-4">
                        Enviamos um código de verificação para
                        <strong>{{ $email }}</strong>.
                        Informe o código abaixo para continuar.
                    </p>

                    @if (session('success'))
                        <div class="alert alert-success small" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger small" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verification.code.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="code" class="form-label">
                                Código de verificação
                            </label>

                            <input
                                type="text"
                                name="code"
                                id="code"
                                class="form-control text-center @error('code') is-invalid @enderror"
                                inputmode="numeric"
                                autocomplete="one-time-code"
                                pattern="[0-9]{6}"
                                maxlength="6"
                                minlength="6"
                                placeholder="000000"
                                value="{{ old('code') }}"
                                required
                                autofocus
                            >

                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Confirmar e-mail
                        </button>
                    </form>

                    <hr class="my-4">

                    <form method="POST" action="{{ route('verification.code.resend') }}">
                        @csrf

                        <p class="text-muted small text-center mb-2">
                            Não recebeu o código ou ele expirou?
                        </p>

                        <button type="submit" class="btn btn-outline-secondary btn-sm w-100">
                            Reenviar código
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
