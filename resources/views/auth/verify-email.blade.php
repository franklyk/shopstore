@extends('layouts.auth')

@section('title', 'Verificação de email')

@section('auth')

    <x-forms.card>

        
        <h4 class="text-center">Verifique seu email</h4>

        <p class="text-center">
            Enviamos um link de verificação para seu email.
            Clique nele para ativar sua conta.
        </p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-buttons.button class="w-100" type="submit">
                Enviar novo link
            </x-buttons.button>
        </form>

    </x-forms.card>

@endsection
