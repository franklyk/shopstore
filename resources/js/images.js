document.addEventListener('DOMContentLoaded', () => {

    const input = document.getElementById('image');
    const preview = document.getElementById('image-preview');

    input.addEventListener('change', (event) => {

        const file = event.target.files[0];

        if (!file) return;

        preview.src = URL.createObjectURL(file);

    });

});

const inputFile = document.querySelector('#input-image');
const previewImage = document.querySelector('#preview-image');
if (inputFile) {
    inputFile.addEventListener('change', function (e) {
        const inputTarget = e.target;
        const file = inputTarget.files[0];

        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', function (e) {
                const readertTarget = e.target;
                const img = document.createElement('img');
                img.src = readertTarget.result;
                // img.classList.add('rounded-circle');
                img.setAttribute('id', 'image');
                previewImage.appendChild(img);
            });
            var oldImage = document.getElementById("image");
            if(oldImage){
                oldImage.remove(this);
            }
            reader.readAsDataURL(file);
        } else {

        }

    })

}
