document.querySelectorAll('.clickable-row').forEach(row => {
    row.addEventListener('click', () => {
        console.log(window.location = row.dataset.href);
        window.location = row.dataset.href;
    });
});
