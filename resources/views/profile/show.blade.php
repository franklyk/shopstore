@extends('layouts.store')

@section('title', 'Minha Conta')

@section('content')

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">
                    <h3 class="mb-0">Minha Conta</h3>
                </div>

                <div class="card-body">

                    <div class="text-center mb-4">

                        <img src="https://placehold.co/100x100" alt="{{ $user->name }}" class="rounded-circle">

                    </div>

                    <dl class="row mb-0">

                        <dt class="col-sm-3">
                            Nome
                        </dt>

                        <dd class="col-sm-9">
                            {{ $user->name }}
                        </dd>

                        <dt class="col-sm-3">
                            E-mail
                        </dt>

                        <dd class="col-sm-9">
                            {{ $user->email }}
                        </dd>

                        <dt class="col-sm-3">
                            Telefone
                        </dt>

                        <dd class="col-sm-9">
                            {{ $user->phone ?: 'Não informado' }}
                        </dd>

                        <dt class="col-sm-3">
                            Cliente desde
                        </dt>

                        <dd class="col-sm-9">
                            {{ $user->created_at->format('d/m/Y') }}
                        </dd>

                    </dl>

                </div>
                <div class="card-footer">

                    <x-buttons.button href="{{ route('profile.edit') }}" color="warning" icon="edit"
                        label="Editar Conta" />

                </div>

            </div>

        </div>

    </div>

@endsection
