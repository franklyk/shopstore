document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('formModal');

    modal.addEventListener('show.bs.modal', (event) => {

        const button = event.relatedTarget;

        const mode = button.dataset.mode;
        const form = modal.querySelector('[data-role="form"]');
        const methodInput = modal.querySelector('[data-role="method"]');

        const { baseUrl, resource } = window.APP_CONFIG;

        if (mode === 'create') {

            modal.querySelector('[data-role="title"]').textContent = 'Novo';

            form.action = `${baseUrl}/${resource}`;
            methodInput.value = 'POST';

            form.reset();

        }

        if (mode === 'edit') {

            const id = button.dataset.id;

            modal.querySelector('[data-role="title"]').textContent = 'Editar';

            form.action = `${baseUrl}/${resource}/${id}`;
            methodInput.value = 'PUT';

            // preencher campos
            form.querySelector('[name="name"]').value = button.dataset.name;
            form.querySelector('[name="price"]').value = button.dataset.price;

        }

    });

});