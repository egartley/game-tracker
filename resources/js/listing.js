$(document).ready(function() {
    const validValues = [10, 20, 35, 50];
    const urlParams = new URLSearchParams(window.location.search);
    const limit = parseInt(urlParams.get('l'));
    const dropdown = $('select#resultnumdropdown');
    if (validValues.includes(limit)) {
        dropdown.val(limit);
    }
    dropdown.change(function () {
        const newLimit = $(this).val();
        const url = new URL(window.location);
        window.location.href = `${url.origin}${url.pathname}?l=${newLimit}`;
    });
});