@props(['id', 'action', 'title' => 'Confirmar exclusão'])

<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{ $slot }}
            </div>

            <div class="modal-footer">

                <x-buttons.button color="secondary" data-bs-dismiss="modal">
                    Cancelar
                </x-buttons.button>

                <form action="{{ $action }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <x-buttons.button type="submit" color="danger">
                        Excluir
                    </x-buttons.button>
                </form>

            </div>

        </div>
    </div>
</div>
