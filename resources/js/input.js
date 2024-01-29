$(document).ready(() => {
    $("select#tagdropdown").change(function () {
        const [id, n] = this.value.split(",");
        if (id !== "none" && $(`span#tag-${id}`).length === 0) {
            add_tag(id, n);
        }
        $("select#tagdropdown").val("none");
    });
    refresh_click_events();
});

function refresh_click_events() {
    $("span.tag-delete-x").off("click");
    $("span.tag-delete-x").click(function () {
        delete_tag($(this));
    });
}

function add_tag(id, n) {
    $("div#tags-container").append(`<span class="game-tag" id="tag-${id}">${id}<span class="tag-delete-x" tagval="${id}" tagid="${n}">X</span></span>`);
    const input = $("input#actualtags");
    const inputval = input.val();
    if (!inputval) {
        input.attr("value", n);
    } else {
        input.attr("value", `${inputval},${n}`);
    }
    refresh_click_events();
}

function delete_tag(tag) {
    const id = tag.attr("tagval");
    const n = tag.attr("tagid");
    const input = $("input#actualtags");
    let inputval = input.val();
    if (inputval.indexOf(",") === -1) {
        input.attr("value", "");
    } else {
        const s = inputval.split(",");
        let newval = s.filter(tagn => tagn !== n).join(",");
        input.attr("value", newval);
    }
    $(`span#tag-${id}`).remove();
}
