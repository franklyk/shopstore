document.querySelectorAll('.input-image').forEach(input => {

    input.addEventListener('change', function (e) {

        const file = e.target.files[0];

        if (!file) return;

        const previewSelector = input.dataset.preview;

        if (!previewSelector) return;

        const preview = document.querySelector(previewSelector);

        if (!preview) return;

        const reader = new FileReader();

        reader.addEventListener('load', function (e) {

            preview.innerHTML = '';

            const img = document.createElement('img');

            img.src = e.target.result;
            img.alt = 'Pré-visualização da imagem';

            preview.appendChild(img);

        });

        reader.readAsDataURL(file);

    });

});
