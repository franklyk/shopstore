
document.addEventListener('DOMContentLoaded', function () {
    
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    const modalFooter = document.getElementById('modalFooter');
    
    document.querySelectorAll('.js-open-modal').forEach(button => {
        console.log('.js-open-modal');
        button.addEventListener('click', function () {
            console.log('NOVO JS CARREGADO');

            const action = this.dataset.action;
            const id = this.dataset.id;
            const name = this.dataset.name;
            const resource = this.dataset.resource;

            if (action === 'delete') {

                modalTitle.textContent = 'Confirmar exclusão';

                modalBody.innerHTML = `
                    Tem certeza que deseja excluir <strong>${name}</strong>?
                `;

                modalFooter.innerHTML = `
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                    <form method="POST" action="/admin/${resource}/${id}">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="_method" value="DELETE">

                        <button class="btn btn-danger">Excluir</button>
                    </form>
                `;
            }

        });

    });

});