@extends('layouts.auth')

@section('auth')

    <div class="form">

        <div class="form-header">

            <div class="form-logo">

                <a>
                    <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">
                </a>

            </div>

            <h4 class="form-title">
                Verificar e-mail
            </h4>

        </div>

        <p class="text-muted small text-center mb-4">

            Enviamos um código de verificação para
            <strong>{{ $email }}</strong>. <br>
            Informe o código abaixo para continuar.

        </p>

        <x-forms.form method="POST" action="{{ route('verification.code.store') }}">

            <div class="d-flex">

                <x-forms.input type="text" name="code" inputmode="numeric"
                    autocomplete="one-time-code" pattern="[0-9]{6}" maxlength="6" minlength="6" placeholder="000000"
                    value="{{ old('code') }}" class="text-center" required autofocus />
                <div class="form-action">
                    <x-buttons.auth label="Confirme" />
                </div>
            </div>

        </x-forms.form>

        <x-forms.form method="POST" action="{{ route('verification.code.resend') }}">

            <p class="text-muted small text-center">
                Não recebeu o código ou ele expirou?
            </p>

            <div class="form-action">
                <x-buttons.auth label="Reenviar código" color="danger" class="m-auto border-none" />
            </div>

        </x-forms.form>
    </div>

@endsection
