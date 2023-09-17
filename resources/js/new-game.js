function sanitize(s) {
    return s.replace(/[^A-Z0-9'",.!:-]/gi, "")
}

function sanitize_num(s) {
    return s.replace(/[^0-9]/g, '')
}

$(document).ready(function () {
    $("button.submit").on("click", function () {
        var title = $("input#title").eq(0).val()
        title = sanitize(title)
        var year = $("input#year").eq(0).val()
        year = sanitize_num(year)
        var platform = $("input#platform").eq(0).val()
        platform = sanitize(platform)
        var company = $("input#company").eq(0).val()
        company = sanitize(company)
        var rating = Number($("input#rating").eq(0).val()).toString()
        var hours = Number($("input#hours").eq(0).val()).toString()
        var playthroughs = Number($("input#playthroughs").eq(0).val()).toString()
        var hundo = $("input#hundo").is(":checked").toString()
        var plat = $("input#plat").is(":checked").toString()
        var dlc = $("input#dlc").is(":checked").toString()
        var physical = $("input#physical").is(":checked").toString()
        window.location = "/inventory/action/?type=new&title=" + encodeURIComponent(title)
            + "&year=" + year + "&platform=" + encodeURIComponent(platform) + "&company="
            + encodeURIComponent(company) + "&rating=" + rating + "&hours=" + hours + "&playthroughs="
            + playthroughs + "&hundo=" + hundo + "&plat=" + plat + "&dlc=" + dlc + "&physical=" + physical
    })
});
