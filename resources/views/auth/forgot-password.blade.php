@extends('layouts.auth')

@section('title', 'Login')

@section('auth')

    <div class="card shadow p-4 w-100">

        <div class="text-center mb-4">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" style="max-width: 150px;">
            </a>
        </div>

        <h4 class="mb-4 text-center">Recuperar senha</h4>

        <x-forms.form method="POST" action="{{ route('password.email') }}">

            {{-- Email --}}
            <x-forms.input name="email" type="email" label="Email" :value="old('email')" />

            {{-- Feedback de status --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Botão --}}
            <x-buttons.button type="submit" color="primary" class="w-100">
                Enviar link de recuperação
            </x-buttons.button>

        </x-forms.form>

        {{-- Link voltar --}}
        <div class="text-center mt-3">
            <a href="{{ route('login') }}">
                Voltar para login
            </a>
        </div>

    </div>
@endsection
