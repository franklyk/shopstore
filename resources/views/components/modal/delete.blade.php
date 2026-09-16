@props(['id', 'action', 'name'])

<div
    class="modal fade"
    id="deleteModal{{ $id }}"
    tabindex="-1"
    aria-labelledby="deleteModalLabel{{ $id }}"
    aria-hidden="true"
>
    <div class="modal-dialog modal-sm">

        <div class="modal-content">

            <div class="modal-header">

                <h5
                    class="modal-title"
                    id="deleteModalLabel{{ $id }}"
                >
                    Excluir
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar"
                ></button>

            </div>

            <div class="modal-body">

                Deseja excluir <strong>{{ $name }}</strong>?

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Cancelar
                </button>

                <form
                    action="{{ $action }}"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        Excluir
                    </button>

                </form>

            </div>

        </div>

    </div>
</div>
