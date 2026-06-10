@extends('layouts.admin')

@section('title', 'Dashboard')

@section('admin')

    <div class="container">

        <div class="card">
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card">

                        <div class="card-body">

                            <h5 class="card-title">
                                Produtos
                            </h5>

                            <p class="card-text">
                                Gerenciar produtos da loja.
                            </p>

                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">
                                Acessar
                            </a>

                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">

                        <div class="card-body">

                            <h5 class="card-title">
                                Categorias
                            </h5>

                            <p class="card-text">
                                Gerenciar categorias.
                            </p>

                            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">
                                Acessar
                            </a>

                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">

                        <div class="card-body">

                            <h5 class="card-title">
                                Usuários
                            </h5>

                            <p class="card-text">
                                Gerenciar usuários.
                            </p>

                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                                Acessar
                            </a>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection
