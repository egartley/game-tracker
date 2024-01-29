$(document).ready(() => {
    $("div.action-button-new").on("click", () => {
        window.location = "/inventory/game/new/"
    });
    $("div.action-button-import").on("click", () => {
        window.location = "/inventory/game/import/"
    });
    $("div.action-button-new-icon").on("click", () => {
        window.location = "/inventory/icon/new/"
    });
});
