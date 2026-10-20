import 'bootstrap';

import './form';

import './cart';

import './custom';

import './images';

import './listing';

import './password';




document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.dropdown-menu').forEach(dropdown => {

        dropdown.addEventListener('click', (e) => {

            e.stopPropagation();

        });

    });

});
