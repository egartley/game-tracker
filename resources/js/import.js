$(document).ready(() => {
    $("button.submit").on("click", () => {
        const csvtext = $("textarea#csvtext").eq(0).val();
        // will be sanitized by php instead of doing it here
        $.post("/inventory/game/action/index.php", {type: "import", csv: csvtext}).done(() => {
            window.location = "/inventory"
        })
    })
});
