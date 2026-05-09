@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2>
                    Detalhes da Categoria
                </h2>
            </div>
        </div>
        
        <h5 class="card-title text-center my-3">{{ $category->name }}</h5>
        <div class="card-body">
            <dl class="row">

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9">{{ $category->name }}</dd>

                <dt class="col-sm-3">Cadastrado em:</dt>
                <dd class="col-sm-9">{{ $category->created_at }}</dd>

                <dt class="col-sm-3">Última atualização em:</dt>
                <dd class="col-sm-9">{{ $category->updated_at }}</dd>

            </dl>
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-secondary">
                Voltar
            </a>

            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                Editar
            </a>
        </div>
    </div>
    
@endsection
