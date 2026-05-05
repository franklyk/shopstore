
document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('deleteModal');

    modal.addEventListener('show.bs.modal', (event) => {

        const button = event.relatedTarget;
        const id = button.dataset.id;
        const name = button.dataset.name;
        const form = modal.querySelector('[data-role="form"]');
        const { baseUrl, resource } = window.APP_CONFIG;

        modal.querySelector('[data-role="id"]').textContent = id;
        modal.querySelector('[data-role="name"]').textContent = name;

        form.action = `${baseUrl}/${resource}/${id}`;

    });

});