$(document).ready(function() {
    $("div.action-button-new").on("click", function() {
        window.location = "/inventory/new/"
    });
    $("div.action-button-import").on("click", function() {
        window.location = "/inventory/import/"
    })
});
