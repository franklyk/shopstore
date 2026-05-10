@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <div class="card-title">
                <h2>Detalhes do Usuário</h2>
            </div>
        </div>
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

        </div>
        <div class="card-footer">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">

                    <path d="M9 14L4 9l5-5" />

                    <path d="M20 20v-7a4 4 0 0 0-4-4H4" />

                </svg>

                Voltar
            </a>

            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 20h9" />
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                </svg>

                Editar
            </a>
        </div>
    </div>
@endsection
