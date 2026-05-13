import 'bootstrap';

import './cart';




document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.dropdown-menu').forEach(dropdown => {

        dropdown.addEventListener('click', (e) => {

            e.stopPropagation();

        });

    });

});