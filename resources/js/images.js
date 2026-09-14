const inputFile = document.querySelector('#input-image');
const previewImage = document.querySelector('#preview-image');

if (inputFile && previewImage) {

    inputFile.addEventListener('change', function (e) {

        const file = e.target.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.addEventListener('load', function (e) {

            previewImage.innerHTML = '';

            const img = document.createElement('img');

            img.src = e.target.result;
            img.setAttribute('id', 'image');

            previewImage.appendChild(img);

        });

        reader.readAsDataURL(file);

    });

}
