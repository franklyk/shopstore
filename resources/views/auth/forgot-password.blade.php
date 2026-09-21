@extends('layouts.auth')

@section('title', 'Login')

@section('auth')
    <div class="form">

        <div class="form-logo">

            <a href="{{ route('home') }}">

                <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">

            </a>

        </div>

        <x-forms.form action="{{ route('password.email') }}" method="POST" title="Recuperar Senha">

            {{-- Email --}}
            <x-forms.input name="email" type="email" label="Email" :value="old('email')" />

            {{-- Feedback de status --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Botão --}}
            <div class="form-action">
                <x-buttons.auth label="Enviar link de recuperação" />
            </div>
        </x-forms.form>

        {{-- Link voltar --}}
        <div class="text-center mt-3">
            <a href="{{ route('login') }}">
                Voltar para login
            </a>
        </div>
    @endsection
