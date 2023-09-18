function sanitize(s) {
    return s.replace(/[^A-Z0-9 '",.!:-]/gi, "")
}

function sanitize_num(s) {
    return s.replace(/[^0-9]/g, '')
}

function get_param_id() {
    let sp = new URLSearchParams(window.location.search)
    if (sp.has("id")) {
        return "&id=" + sanitize_num(sp.get("id"))
    } else {
        return "&id=-1"
    }
}

$(document).ready(function () {
    var type = $("button.submit").attr("inputtype").replace(/[^A-Z]/gi, "")
    $("button.submit").on("click", function () {
        var title = sanitize($("input#title").eq(0).val())
        var year = sanitize_num($("input#year").eq(0).val())
        var platform = sanitize($("input#platform").eq(0).val())
        var company = sanitize($("input#company").eq(0).val())
        var rating = Number($("input#rating").eq(0).val()).toString()
        var hours = Number($("input#hours").eq(0).val()).toString()
        var playthroughs = Number($("input#playthroughs").eq(0).val()).toString()
        var hundo = $("input#hundo").is(":checked") ? 1 : 0
        var plat = $("input#plat").is(":checked") ? 1 : 0
        var dlc = $("input#dlc").is(":checked") ? 1 : 0
        var physical = $("input#physical").is(":checked") ? 1 : 0
        var idaddon = type == "edit" ? get_param_id() : ""
        window.location = "/inventory/action/?type=" + type + "&title=" + encodeURIComponent(title)
            + "&year=" + year + "&platform=" + encodeURIComponent(platform) + "&company="
            + encodeURIComponent(company) + "&rating=" + rating + "&hours=" + hours + "&playthroughs="
            + playthroughs + "&hundo=" + hundo + "&plat=" + plat + "&dlc=" + dlc + "&physical=" + physical + "&r=1" + idaddon
    });
    if (type == "edit") {
        $("input#title").val($("span#gamedata-title").html())
        $("input#year").val($("span#gamedata-year").html())
        $("input#platform").val($("span#gamedata-platform").html())
        $("input#company").val($("span#gamedata-company").html())
        $("input#rating").val($("span#gamedata-rating").html())
        $("span#ratingvalue").html($("span#gamedata-rating").html())
        $("input#hours").val($("span#gamedata-hours").html())
        $("input#playthroughs").val($("span#gamedata-playthroughs").html())
        $("input#hundo").prop("checked", $("span#gamedata-hundo").html() == 1)
        $("input#plat").prop("checked", $("span#gamedata-plat").html() == 1)
        $("input#dlc").prop("checked", $("span#gamedata-dlc").html() == 1)
        $("input#physical").prop("checked", $("span#gamedata-physical").html() == 1)
    }
});
