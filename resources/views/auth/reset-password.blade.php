@extends('layouts.auth')

@section('title', 'Reset Password')

@section('auth')
    <x-forms.form method="POST" action="{{ route('password.update') }}" title="Redefinir Senha">

        {{-- Token --}}
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        {{-- Email --}}
        <x-forms.input name="email" type="email" label="Email" :value="old('email', request('email'))" />

        {{-- Nova Senha --}}
        <x-forms.input name="password" type="password" label="Nova Senha" />

        {{-- Confirmar Senha --}}
        <x-forms.input name="password_confirmation" type="password" label="Confirmar Senha" />

        {{-- Botão --}}
        <x-buttons.button type="submit" color="primary" class="w-100">
            Salvar nova senha
        </x-buttons.button>

    </x-forms.form>

@endsection
