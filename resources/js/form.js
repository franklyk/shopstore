const previewImage = document.querySelector('#preview-image');

const previewImageDefault = previewImage?.innerHTML;

const formCreate = document.querySelector('#form-create');

const modalCreateFeedback = document.querySelector('#modal-create-feedback');

if (formCreate) {

    formCreate.addEventListener('submit', async function (event) {

        event.preventDefault();

        const form = event.currentTarget;

        const formData = new FormData(form);

        try {

            const response = await fetch(form.action, {

                method: form.method,

                body: formData,

                headers: {

                    'Accept': 'application/json',

                },

            });

            const clearFormErrors = (form) => {

                form.querySelectorAll('.is-invalid').forEach(input => {
                    input.classList.remove('is-invalid');
                });

                form.querySelectorAll('.invalid-feedback').forEach(feedback => {
                    feedback.remove();
                });

            };
            const showCreateFeedback = (message) => {

                if (!modalCreateFeedback) {
                    return;
                }

                modalCreateFeedback.textContent = message;

                setTimeout(() => {

                    modalCreateFeedback.textContent = '';

                }, 3000);

            };

            const data = await response.json();

            if (response.status === 422) {

                form.querySelectorAll('.is-invalid').forEach(input => {

                    input.classList.remove('is-invalid');

                });

                form.querySelectorAll('.invalid-feedback').forEach(feedback => {

                    feedback.remove();

                });

                Object.entries(data.errors).forEach(([field, messages]) => {

                    if (field === 'categories') {

                        const inputs = form.querySelectorAll(
                            '[name="categories[]"]'
                        );

                        inputs.forEach(input => {

                            input.classList.add('is-invalid');

                        });

                        const categories = form.querySelector(
                            '.product-create-categories'
                        );

                        if (categories) {

                            const feedback = document.createElement('div');

                            feedback.classList.add(
                                'invalid-feedback',
                                'd-block'
                            );

                            feedback.textContent = messages[0];

                            categories.insertAdjacentElement(
                                'afterend',
                                feedback
                            );

                        }

                        return;
                    }

                    const input = form.querySelector(
                        `[name="${field}"]`
                    );

                    if (!input) {

                        return;

                    }

                    input.classList.add('is-invalid');

                    const feedback = document.createElement('div');

                    feedback.classList.add('invalid-feedback');

                    feedback.textContent = messages[0];

                    input.insertAdjacentElement(
                        'afterend',
                        feedback
                    );

                });

                return;

            }

            if (response.ok && data.success) {

                form.reset();

                clearFormErrors(form);

                if (previewImage) {

                    previewImage.innerHTML = previewImageDefault;

                }

                const responseListing = await fetch(
                    '/admin/products',
                    {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    }
                );

                const listing = await responseListing.text();

                document.querySelector(
                    '.listing-content'
                ).innerHTML = listing;

                showCreateFeedback(data.message);

                return;

            }



        } catch (error) {

            console.error('ERRO AJAX:', error);

        }

    });

}
