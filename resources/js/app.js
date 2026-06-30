import 'bootstrap';

import './cart';

import './custom';

import './images';




document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.dropdown-menu').forEach(dropdown => {

        dropdown.addEventListener('click', (e) => {

            e.stopPropagation();

        });

    });

});
