@props(['action', 'title' => 'Cadastrar'])

<div class="modal fade modal-create" id="modal-create" tabindex="-1" aria-labelledby="modal-create-label"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="modal-create-label">
                    {{ $title }}
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

            </div>


            <div class="modal-body">
                <x-forms.form action="{{ $action }}" method="POST" enctype="multipart/form-data"
                    id="form-create">

                    {{ $slot }}

                </x-forms.form>
            </div>

            <div class="modal-footer">
                <x-buttons.return label="Cancelar" data-bs-dismiss="modal"  />

                <x-buttons.create type="submit" icon="check"/>

            </div>

        </div>

    </div>

</div>
