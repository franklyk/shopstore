@extends('layouts.app')

@section('content')

<h2>Detalhes do Usuário</h2>


<div class="card">
        <h5 class="card-title text-center my-3">{{ $user->name }}</h5>
        <div class="card-body">
            <dl class="row">

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3">Cadastrado em:</dt>
                <dd class="col-sm-9">{{ $user->created_at }}</dd>

                <dt class="col-sm-3">Última atualização em:</dt>
                <dd class="col-sm-9">{{ $user->updated_at }}</dd>

            </dl>
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                Voltar
            </a>

            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">
                Editar
            </a>
        </div>
    </div>

@endsection