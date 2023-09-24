$(document).ready(function () {
    $("button.submit").on("click", function () {
        const csvtext = $("textarea#csvtext").eq(0).val();
        // will be sanitized by php instead of doing it here
        $.post("/inventory/action/index.php", {type: "import", csv: csvtext}).done(function () {
            window.location = "/inventory"
        })
    })
});
