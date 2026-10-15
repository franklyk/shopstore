@extends('layouts.admin')

@section('layout-admin')
    <x-layout.admin.page>
        <x-slot:header>
            <x-ui.page-header title="Detalhes do Produto">

                <x-slot:actions>
                    <x-ui.breadcrumbs :items="[
                        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                        ['label' => 'Produtos', 'url' => route('admin.products.index')],
                        ['label' => 'Visualizar'],
                    ]" />
                    <div class="container-buttons">
                        @can('view products')
                            <x-buttons.button href="{{ route('admin.system.users.index') }}" color="secondary" icon="return"
                                label="Voltar" />
                        @endcan

                        @can('edit users')
                            <x-buttons.edit label="Editar" data-bs-toggle="modal" data-bs-target="#modal-edit" />
                        @endcan

                        @can('delete products')
                            <x-buttons.delete data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}" />
                        @endcan

                    </div>
                </x-slot:actions>

            </x-ui.page-header>
        </x-slot:header>

        @include('admin.system.users.partials.details', [
            'users' => $user,
        ])




        <x-modal.edit action="{{ route('admin.products.update', $user) }}">

            <div class="modal-container">

                <div class="modal-main">

                    <div class="modal-fields">

                        <x-forms.input type="text" name="name" label="Produto:" :value="old('name', $user->name)" />

                        {{-- <div class="auto-grid">

                            <x-forms.input type="number" name="price" label="Preço:" :value="old('price', $product->price)" step="0.01"
                                min="0" />

                            <x-forms.select name="brand_id" label="Marca:" :options="$brands->pluck('name', 'id')->toArray()" :selected="old('brand_id', $product->brand_id)" />

                            <x-forms.select name="collection_id" label="Coleção:" :options="$collections->pluck('name', 'id')->toArray()" :selected="old('collection_id', $product->collections->first()?->id)" />

                            <x-forms.select name="supplier_id" label="Fornecedor:" :options="$suppliers->pluck('name', 'id')->toArray()" :selected="old('supplier_id', $product->suppliers->first()?->id)" />

                        </div> --}}

                    </div>

                    <div class="div">

                        <div class="modal-image">

                            <label class="modal-image-label" for="input-image">

                                {{-- <div class="modal-image-preview" id="preview-image">

                                    @if ($user->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $user->images->first()->image) }}"
                                            alt="{{ $user->name }}">
                                    @else
                                        <x-icons.camera />
                                    @endif

                                </div> --}}

                            </label>

                            <input class="input-image" type="file" name="image" id="input-image" accept="image/*"
                                data-preview="#preview-image">

                        </div>

                        {{-- <x-buttons.status :statuses="$statuses" :status-id="$user->status_id" /> --}}

                    </div>

                </div>

                {{-- CATEGORIAS --}}

                {{-- <div class="modal-section">

                    <h3 class="section-title">
                        Categorias
                    </h3>

                    <div class="product-edit-categories checkbox-groups">

                        @foreach ($categories as $parent)
                            <div class="product-edit-category checkbox-options">

                                <div class="product-edit-category-parent checkbox-options-parent">
                                    {{ $parent->name }}
                                </div>

                                @forelse ($parent->children as $child)
                                    <x-forms.checkbox :name="'categories[]'" :label="$child->name" :value="$child->id"
                                        :id="'edit-category-' . $child->id" :checked="$product->categories->contains($child->id)" />

                                @empty

                                    <small class="text-muted">
                                        Sem subcategorias
                                    </small>
                                @endforelse

                            </div>
                        @endforeach

                    </div>

                </div> --}}

            </div>

        </x-modal.edit>

        @section('modals')

            <x-modal.delete :id="$user->id" :action="route('admin.system.users.destroy', $user)" :name="$user->name" />

        @endsection
    </x-layout.admin.page>














    <div class="details page-container">
        
        <x-ui.page-header title="Detalhes do Usuário" description="Visualize todos o detalhes do usuário.">

            <x-slot:actions>

                <x-ui.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Usuários', 'url' => route('admin.system.users.index')],
                    ['label' => 'Visualizar'],
                ]" />

                <div class="container-buttons">

                    @can('view users')
                        <x-buttons.button href="{{ route('admin.system.users.index') }}" color="secondary" icon="return"
                            label="Voltar" />
                    @endcan

                    @can('edit users')
                        <x-buttons.button href="{{ route('admin.system.users.edit', $user) }}" color="warning" icon="edit"
                            label="Editar" />
                    @endcan

                    @can('delete users')
                        <x-buttons.button color="danger" icon="trash" label="Excluir" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $user->id }} " />
                    @endcan

                </div>

            </x-slot:actions>

        </x-ui.page-header>

        <div class="card p-5 bg-light">

            <div class="card border border-1 shadow container-image mb-5 rounded-4">

                <div class="preview-image" id="preview-image">
                    @if ($user->avatar)
                        <img class="m-auto" src="{{ asset('storage/' . $user->avatar) }}" id="image">
                    @else
                        <div class="preview-placeholder d-flex justify-content-center">
                            <x-icons.camera />
                        </div>
                    @endif
                </div>

                <label class="label-image" for="input-image">
                    <input class="input-image" type="file" name="input-image" id="input-image" accept="image/*">
                </label>

            </div>

            <div class="card p-3 shadow">

                <dl class="row">

                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">{{ $user->id }}</dd>

                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">Telefone</dt>
                    <dd class="col-sm-9">{{ $user->phone }}</dd>

                    <dt class="col-sm-3">Verificação do Email</dt>
                    <dd class="col-sm-9">{{ $user->email_verified_at }}</dd>

                    <dt class="col-sm-3">Cadastrado em:</dt>
                    <dd class="col-sm-9">{{ $user->created_at }}</dd>

                    <dt class="col-sm-3">Última atualização em:</dt>
                    <dd class="col-sm-9">{{ $user->updated_at }}</dd>

                </dl>
            </div>
        </div>
    </div>

@section('modals')
    @can('delete users')
        <x-modal.delete :action="route('admin.system.users.destroy', $user)" :id="$user->id" :name="$user->name" />
    @endcan
@endsection

@endsection
