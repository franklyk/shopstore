const passwordForms = document.querySelectorAll('form');

passwordForms.forEach((form) => {

    const showPassword = form.querySelector(
        '[name="show_password"]'
    );

    if (!showPassword) {
        return;
    }

    const passwordInputs = form.querySelectorAll(
        'input[type="password"]'
    );

    showPassword.addEventListener('change', () => {

        passwordInputs.forEach((input) => {

            input.type = showPassword.checked
                ? 'text'
                : 'password';

        });

    });

});
