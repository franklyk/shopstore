const listingContent = document.querySelector('.listing-content');

const listingFilters = document.querySelector('.listing-filters');

const perPage = document.querySelector('#per-page');



const updateUrl = (params) => {

    const queryString = params.toString();

    window.history.replaceState(

        {},

        '',

        queryString
            ? `${window.location.pathname}?${queryString}`
            : window.location.pathname

    );

};



const loadListing = async (params) => {

    const response = await fetch(

        `${window.location.pathname}?${params.toString()}`,

        {

            headers: {

                'X-Requested-With': 'XMLHttpRequest',

            },

        }

    );

    if (!response.ok) {

        throw new Error(

            `Erro ao carregar a listagem: ${response.status}`

        );

    }

    const listing = await response.text();

    listingContent.innerHTML = listing;

    updateUrl(params);

};



/**
 * ////////////////////////////////////////////////////////////////////
 * Itens por página
 * ////////////////////////////////////////////////////////////////////
 */

if (perPage && listingContent) {

    perPage.addEventListener('change', async function () {

        const params = new URLSearchParams(

            window.location.search

        );

        params.set('per_page', this.value);

        params.delete('page');

        try {

            await loadListing(params);

        } catch (error) {

            console.error(error);

        }

    });

}



/**
 * ////////////////////////////////////////////////////////////////////
 * Filtros
 * ////////////////////////////////////////////////////////////////////
 */

if (listingFilters && listingContent) {

    listingFilters
        .querySelectorAll('input, select')
        .forEach(input => {

            input.addEventListener('change', async function () {

                const formData = new FormData(listingFilters);

                const params = new URLSearchParams(formData);

                params.delete('page');

                try {

                    await loadListing(params);

                } catch (error) {

                    console.error(error);

                }

            });

        });

}



const search = listingFilters?.querySelector(

    'input[type="search"]'

);



if (search && listingContent) {

    let searchTimeout;

    search.addEventListener('input', function () {

        clearTimeout(searchTimeout);

        searchTimeout = setTimeout(async () => {

            const formData = new FormData(listingFilters);

            const params = new URLSearchParams(formData);

            params.delete('page');

            try {

                await loadListing(params);

            } catch (error) {

                console.error(error);

            }

        }, 400);

    });

}



/**
 * ////////////////////////////////////////////////////////////////////
 * Paginação
 * ////////////////////////////////////////////////////////////////////
 */

if (listingContent) {

    listingContent.addEventListener('click', async function (event) {

        const link = event.target.closest('.pagination a');

        if (!link) {

            return;

        }

        event.preventDefault();

        const url = new URL(link.href);

        const params = url.searchParams;

        try {

            await loadListing(params);

        } catch (error) {

            console.error(error);

        }

    });

}
