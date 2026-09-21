@extends('layouts.auth')

@section('title', 'Verificação de email')

@section('auth')

    <div class="form">

        <div class="form-header">

            <div class="form-logo">

                <a href="{{ route('home') }}">

                    <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">

                </a>

            </div>

            <h4 class="form-title">
                Verificação de email
            </h4>

        </div>

        <p class="form-description">
            Enviamos um link de verificação para {{ $user->maskedEmail() }}.
        </p>

        <x-forms.form method="POST" action="{{ route('verification.send') }}">

            <div class="form-action">

                <x-buttons.auth type="submit" label="Enviar novo link" />

            </div>

        </x-forms.form>

    </div>

@endsection
