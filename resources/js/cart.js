console.log('NOVO JS CARREGADO');

/* =========================
   DEBOUNCE
========================= */
function debounce(fn, delay = 500) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn.apply(this, args), delay);
    };
}

/* =========================
           RECALCULAR TOTAL
        ========================= */
function recalculateTotal() {

    let total = 0;

    document.querySelectorAll('.subtotal').forEach(el => {
        const value = parseFloat(el.dataset.value);
        if (!isNaN(value)) total += value;
    });

    document.getElementById('cart-total').innerText =
        'R$ ' + total.toFixed(2).replace('.', ',');
}

/* =========================
           UPDATE QUANTIDADE
        ========================= */
const handleQuantityChange = debounce(function (input) {

    const id = input.dataset.id;
    let quantity = parseInt(input.value);

    if (isNaN(quantity) || quantity < 1) {
        quantity = 1;
        input.value = 1;
    }

    input.disabled = true;

    fetch(`/cart/update/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            quantity: quantity
        })
    })
        .then(res => res.json())
        .then(data => {

            const row = input.closest('tr');

            const price = parseFloat(row.querySelector('.price').dataset.price);

            if (isNaN(price)) {
                console.error('Preço inválido');
                return;
            }

            const subtotal = price * quantity;

            const subtotalCell = row.querySelector('.subtotal');

            subtotalCell.dataset.value = subtotal;
            subtotalCell.innerText =
                'R$ ' + subtotal.toFixed(2).replace('.', ',');

            recalculateTotal();

        })
        .catch(err => console.error(err))
        .finally(() => {
            input.disabled = false;
        });

}, 500);

/* =========================
           EVENTO INPUT
        ========================= */
document.querySelectorAll('.input-qty').forEach(input => {

    input.addEventListener('input', function () {
        handleQuantityChange(this);
    });

});


/* =========================
           REMOVER ITEM
        ========================= */
function initRemoveItem() {

    document.querySelectorAll('.btn-remove').forEach(button => {
        console.log('CLICK REMOVE', button);
        button.addEventListener('click', function () {

            const id = this.dataset.id;

            fetch(`/cart/remove/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ _method: 'DELETE' })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.closest('tr').remove();
                    recalculateTotal();
                }
            })
            .catch(err => console.error(err));

        });

    });
}
initRemoveItem();
