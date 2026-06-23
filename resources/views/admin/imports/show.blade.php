@extends('layouts.admin')

@section('title', 'Detalhes da Importação')

@section('admin')
    <div class="container-fluid">

        <x-ui.page-header title="Detalhes da Importação" description="Visualize os dados do PDF enviado para processamento.">

            <x-slot:actions>

                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Importações', 'url' => route('admin.imports.index')],
                    ['label' => 'Visualizar'],
                ]" />

                <div class="container-buttons">

                    @can('view import batches')
                        <x-buttons.button href="{{ route('admin.imports.index') }}" color="return" icon="return" label="Voltar" />
                    @endcan

                    @can('view import batches')
                        <x-buttons.button href="{{ route('admin.imports.pdf', $import) }}" color="view" icon="eye"
                            label="Abrir PDF" />
                    @endcan

                </div>

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card-vs">

            <dl class="desc-list">

                <dt>ID</dt>
                <dd>{{ $import->id }}</dd>

                <dt>Arquivo</dt>
                <dd>{{ $import->original_name }}</dd>

                <dt>Status</dt>
                <dd>{{ $import->status }}</dd>

                <dt>Caminho do arquivo</dt>
                <dd>{{ $import->file_path }}</dd>

                <dt>Cadastrado em</dt>
                <dd>{{ $import->created_at }}</dd>

                <dt>Última atualização</dt>
                <dd>{{ $import->updated_at }}</dd>

            </dl>

        </div>

    </div>
@endsection
