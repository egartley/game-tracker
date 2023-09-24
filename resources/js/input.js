function sanitize(s) {
    return s.replace(/[^A-Z0-9 '",.!:-]/gi, "")
}

function sanitize_num(s) {
    return s.replace(/[^0-9]/g, '')
}

function get_url_params() {
    return new URLSearchParams(window.location.search)
}

function get_param_id() {
    let sp = get_url_params()
    if (sp.has("id")) {
        return "&id=" + sanitize_num(sp.get("id"))
    } else {
        return "&id=-1"
    }
}

$(document).ready(function () {
    const type = $("button.submit").attr("inputtype").replace(/[^A-Z]/gi, "");
    $("button.submit").on("click", function () {
        const title = sanitize($("input#title").eq(0).val());
        const year = sanitize_num($("input#year").eq(0).val());
        const platform = sanitize($("input#platform").eq(0).val());
        const company = sanitize($("input#company").eq(0).val());
        const rating = Number($("input#rating").eq(0).val()).toString();
        const hours = Number($("input#hours").eq(0).val()).toString();
        const playthroughs = Number($("input#playthroughs").eq(0).val()).toString();
        const hundo = $("input#hundo").is(":checked") ? 1 : 0;
        const plat = $("input#plat").is(":checked") ? 1 : 0;
        const dlc = $("input#dlc").is(":checked") ? 1 : 0;
        const physical = $("input#physical").is(":checked") ? 1 : 0;
        $.post("/inventory/action/index.php", {
            type: type, title: title, year: year, platform: platform,
            company: company, rating: rating, hours: hours, playthroughs: playthroughs, hundo: hundo, plat: plat,
            dlc: dlc, physical: physical, id: type === "edit" ? get_param_id() : ""
        }).done(function () {
            window.location = "/inventory"
        })
    });
    if (type === "edit") {
        $("input#title").val($("span#gamedata-title").html())
        $("input#year").val($("span#gamedata-year").html())
        $("input#platform").val($("span#gamedata-platform").html())
        $("input#company").val($("span#gamedata-company").html())
        $("input#rating").val($("span#gamedata-rating").html())
        $("span#ratingvalue").html($("span#gamedata-rating").html())
        $("input#hours").val($("span#gamedata-hours").html())
        $("input#playthroughs").val($("span#gamedata-playthroughs").html())
        $("input#hundo").prop("checked", $("span#gamedata-hundo").html() === 1)
        $("input#plat").prop("checked", $("span#gamedata-plat").html() === 1)
        $("input#dlc").prop("checked", $("span#gamedata-dlc").html() === 1)
        $("input#physical").prop("checked", $("span#gamedata-physical").html() === 1)
        $("button.delete").on("click", function () {
            $.post("/inventory/action/index.php", {
                type: "delete", id: sanitize_num(get_url_params().get("id"))
            }).done(function () {
                window.location = "/inventory"
            })
        })
    }
});
