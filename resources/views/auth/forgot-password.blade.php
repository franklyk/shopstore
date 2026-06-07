@extends('layouts.auth')

@section('title', 'Login')

@section('auth')

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
        <x-buttons.button type="submit" color="primary" class="w-100" label="Enviar link de recuperação" />
    </x-forms.form>

    {{-- Link voltar --}}
    <div class="text-center mt-3">
        <a href="{{ route('login') }}">
            Voltar para login
        </a>
    </div>
@endsection
