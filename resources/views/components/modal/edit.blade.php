@props(['action', 'title' => 'Editar'])

<div class="modal fade modal-edit" id="modal-edit" tabindex="-1" aria-labelledby="modal-edit-label" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">

                <div>

                    <h5 class="modal-title" id="modal-edit-label">
                        {{ $title }}
                    </h5>

                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>

            </div>

            <div class="modal-body">

                <div id="modal-edit-feedback" class="modal-edit-feedback"></div>

                <x-forms.form action="{{ $action }}" method="PUT" enctype="multipart/form-data" id="form-edit">

                    {{ $slot }}

                </x-forms.form>

            </div>

            <div class="modal-footer">

                <x-buttons.return label="Cancelar" data-bs-dismiss="modal" />

                <x-buttons.edit label="Salvar" type="submit" icon="check" />

            </div>

        </div>

    </div>

</div>
