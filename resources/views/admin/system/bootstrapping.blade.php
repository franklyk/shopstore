@extends('layouts.admin')

@section('title', 'Inicialização do ShopStore')

@section('layout-admin')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <h1 class="mb-4">Inicialização do ShopStore</h1>
                <p>Cadastre a conta inicial do proprietário do sistema.</p>

                <form method="POST" action="{{ route('bootstrap.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input id="name" name="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required
                            autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input id="email" name="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input id="password" name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            Confirmar senha
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Criar conta Owner
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
