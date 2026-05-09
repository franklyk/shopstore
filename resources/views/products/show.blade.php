@extends('layouts.app')

@section('content')
    <h2>Detalhes do Produto</h2>
    
    <div class="card">
        <h5 class="card-title text-center my-3">{{ $product->name }}</h5>
        <div class="card-body">
            <dl class="row">

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9">{{ $product->name }}</dd>

                <dt class="col-sm-3">Descrição</dt>
                <dd class="col-sm-9">{{ $product->description }}</dd>

                <dt class="col-sm-3">Preço</dt>
                <dd class="col-sm-9">{{ $product->price }}</dd>

                <dt class="col-sm-3">Estoque</dt>
                <dd class="col-sm-9">{{ $product->stock }}</dd>

                <dt class="col-sm-3">Cadastrado em:</dt>
                <dd class="col-sm-9">{{ $product->created_at }}</dd>

                <dt class="col-sm-3">Última atualização em:</dt>
                <dd class="col-sm-9">{{ $product->updated_at }}</dd>

            </dl>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">
                Voltar
            </a>

            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">
                Editar
            </a>
        </div>
    </div>
    
@endsection
