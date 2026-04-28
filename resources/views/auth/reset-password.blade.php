@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card shadow p-4 w-100" style="max-width: 420px;">

        <h4 class="mb-4 text-center">Redefinir Senha</h4>

        <x-forms.form method="POST" action="{{ route('password.update') }}">

            {{-- Token --}}
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            {{-- Email --}}
            <x-forms.input 
                name="email" 
                type="email" 
                label="Email" 
                :value="old('email', request('email'))" 
            />

            {{-- Nova Senha --}}
            <x-forms.input 
                name="password" 
                type="password" 
                label="Nova Senha" 
            />

            {{-- Confirmar Senha --}}
            <x-forms.input 
                name="password_confirmation" 
                type="password" 
                label="Confirmar Senha" 
            />

            {{-- Botão --}}
            <x-buttons.button type="submit" color="primary" class="w-100">
                Salvar nova senha
            </x-buttons.button>

        </x-forms.form>

    </div>

</div>
    
@endsection