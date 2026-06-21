document.addEventListener('DOMContentLoaded', () => {

    const input = document.getElementById('image');
    const preview = document.getElementById('image-preview');

    input.addEventListener('change', (event) => {

        const file = event.target.files[0];

        if (!file) return;

        preview.src = URL.createObjectURL(file);

    });

});
