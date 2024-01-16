$(document).ready(function () {
    $("select#tagdropdown").change(function () {
        var v = this.value.split(",");
        var id = v[0];
        var n = v[1];
        if (id !== "none" && $("span#tag-" + id).length == 0)  {
            add_tag(id, n)
        }
        $("select#tagdropdown").val("none")
    });
    refresh_click_events()
});

function refresh_click_events() {
    $("span.tag-delete-x").off("click");
    $("span.tag-delete-x").click(function () {
        delete_tag($(this))
    })
}

function add_tag(id, n) {
    $("div#tags-container").append("<span class=\"game-tag\" id=\"tag-" + id
        + "\">" + id + "<span class=\"tag-delete-x\" tagval=\"" + id + "\" tagid=\"" + n + "\">X</span></span>");
    var input = $("input#actualtags");
    var inputval = input.val();
    if (inputval == "" || inputval == undefined) {
        // adding the first tag
        input.attr("value", n)
    } else if (inputval.length > 0) {
        // adding a second tag
        input.attr("value", inputval + "," + n)
    }
    refresh_click_events()
}

function delete_tag(tag) {
    var id = tag.attr("tagval");
    var n = tag.attr("tagid");
    var input = $("input#actualtags");
    var inputval = input.val();
    if (inputval.indexOf(",") == -1) {
        input.attr("value", "")
    } else {
        var s = inputval.split(",");
        var newval = "";
        for (const tagn of s) {
            if (tagn !== n) {
                newval += tagn + ","
            }
        }
        newval = newval.substring(0, newval.length - 1);
        input.attr("value", newval)
    }
    $("span#tag-" + id).remove()
}
