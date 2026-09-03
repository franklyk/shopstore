document.querySelectorAll('.clickable-row').forEach(row => {
    row.addEventListener('click', () => {
        console.log(window.location = row.dataset.href);
        window.location = row.dataset.href;
    });
});

document.querySelectorAll('.status-button').forEach(button => {


    button.addEventListener('click', function () {

        const inputId = this.dataset.input;

        const input = this
            .closest('.status-button-wrapper')
            .querySelector(`input[name="${inputId}"]`);

        const activeId = this.dataset.activeId;
        const inactiveId = this.dataset.inactiveId;

        const label = this.querySelector('.status-button-label');

        const isActive = this.classList.toggle('active');

        input.value = isActive ? activeId : inactiveId;

        label.textContent = isActive ? 'Ativo' : 'Inativo';

    });

});
