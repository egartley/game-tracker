$(document).ready(function () {
    $("div.action-button-new").on("click", function () {
        window.location = "/inventory/game/new/"
    });
    $("div.action-button-import").on("click", function () {
        window.location = "/inventory/game/import/"
    });
    $("div.action-button-new-icon").on("click", function () {
        window.location = "/inventory/icon/new/"
    })
});
