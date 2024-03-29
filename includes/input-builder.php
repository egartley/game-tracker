<?php

require_once 'game.php';
require_once 'game-fetcher.php';
require_once 'tag-fetcher.php';

function get_input_game_id(string $type)
{
    if ($type === 'edit' && isset($_GET['id'])) {
        return (int)preg_replace('/[^0-9]/', '', $_GET['id']);
    }
    return 'new';
}

function get_input_game(string $type, string $id): Game
{
    if ($id === 'new') {
        return new Game();
    }
    return get_game_by_id((int)$id);
}

function get_input_icon_file(Game $game): string
{
    if (isset($_GET['icon']) && isset($_GET['file'])) {
        return $_GET['file'];
    }
    return $game->iconfile === "" ? 'default-icon.png' : $game->iconfile;
}

function get_input_icon_id(Game $game): int
{
    if (isset($_GET['icon'])) {
        return (int)preg_replace('/[^0-9]/', '', $_GET['icon']);
    }
    return $game->iconid;
}

function input_get_tag_options(): string
{
    $alltags = get_all_tags();
    $tagoptions = '<option value="none">(None)</option>';
    foreach ($alltags as $tag) {
        $tagoptions .= '<option value="' . htmlspecialchars($tag->text) . ',' . $tag->id . '">' . htmlspecialchars($tag->text) . '</option>';
    }
    return $tagoptions;
}

function get_input_html(string $type): void
{
    $id = get_input_game_id($type);
    $game = get_input_game($type, $id);
    $iconfile = get_input_icon_file($game);
    $iconid = get_input_icon_id($game);
    $tagoptions = input_get_tag_options();
    $gametags = get_game_tags($game);

    echo '<form action="/inventory/game/action/index.php" method="post" enctype="multipart/form-data" class="flex col">
        <input type="hidden" name="id" value="' . $id . '">
        <input type="hidden" name="type" value="' . $type . '">
        <!-- why do html checkboxes have to be such a pain... -->
        <input type="hidden" id="actualhundo" name="hundo" value="' . ($game->hundo ? 1 : 0) . '">
        <input type="hidden" id="actualplat" name="plat" value="' . ($game->plat ? 1 : 0) . '">
        <input type="hidden" id="actualdlc" name="dlc" value="' . ($game->dlc ? 1 : 0) . '">
        <input type="hidden" id="actualphysical" name="physical" value="' . ($game->physical ? 1 : 0) . '">
        <input type="hidden" id="actualiconid" name="iconid" value="' . $iconid . '">
        <input type="hidden" id="actualtags" name="tags" value="' . $game->tags . '">

        <div class="input-container flex">
            <div class="icon-picker-container flex col" style="margin-right:24px">
                <img id="icon-picker-img" src="/resources/png/icon/' . $iconfile . '">
                <div class="flex" style="justify-content:center;margin-top:8px">
                    <button type="button" style="margin-right:12px" onclick="window.location.href=\'/inventory/icon/pick/?game=' . $id . '\'">Pick...</button>
                    <button type="button" onclick="$(\'input#actualiconid\').val(\'0\');
                        $(\'img#icon-picker-img\').attr(\'src\', \'/resources/png/icon/default-icon.png\')">Clear</button>
                </div>
            </div>
            <div class="edit-container flex col">
                <div>
                    <input placeholder="Title" type="text" id="title" name="title" maxlength="200" value="' . $game->title . '" style="font-size:22px;width:400px">
                </div>
                <div>
                    <label for="rating">Rating:</label>
                    <input type="range" id="rating" name="rating" min="0" max="5" step="0.5"
                        oninput="$(\'span#ratingvalue\').html($(this).val())" value="' . $game->rating . '">
                    <span id="ratingvalue">' . $game->rating . '</span>
                </div>
                <div>
                    <input placeholder="Year" type="number" id="year" name="year" maxlength="4"' . ($game->year == 0 ? '' : ' value="' . $game->year . '"') . '>
                </div>
                <div>
                    <input placeholder="Platform" type="text" id="platform" name="platform" maxlength="50" value="' . $game->platform . '">
                </div>
                <div>
                    <input placeholder="Company/Developer" type="text" id="company" name="company" maxlength="100" value="' . $game->company . '">
                </div>
                <div>
                    <input placeholder="Hours" type="number" id="hours" name="hours" maxlength="3" value="' . $game->hours . '">
                    <span style="margin-right:18px">hours</span>
                    <input placeholder="Times played" style="width:30px" type="number" id="playthroughs" name="playthroughs" maxlength="3" value="' . $game->playthroughs . '">
                    <span>playthroughs</span>
                </div>
                <div id="toggles-container">
                    <label for="hundo">100%:</label>
                    <input type="checkbox" id="hundo" ' . ($game->hundo ? ' checked' : '') . '
                        onclick="$(\'input#actualhundo\').val($(this).is(\':checked\') ? \'1\' : \'0\')">
                    <label for="plat">Platinum Trophy:</label>
                    <input type="checkbox" id="plat" ' . ($game->plat ? ' checked' : '') . '
                        onclick="$(\'input#actualplat\').val($(this).is(\':checked\') ? \'1\' : \'0\')">
                    <label for="dlc">DLC:</label>
                    <input type="checkbox" id="dlc" ' . ($game->dlc ? ' checked' : '') . '
                        onclick="$(\'input#actualdlc\').val($(this).is(\':checked\') ? \'1\' : \'0\')">
                    <label for="physical">Physical Copy:</label>
                    <input type="checkbox" id="physical" ' . ($game->physical ? ' checked' : '') . '
                        onclick="$(\'input#actualphysical\').val($(this).is(\':checked\') ? \'1\' : \'0\')">
                </div>
                <div id="tags-container">
                    <span style="margin-right:8px">Tags:</span>' . $game->get_tags_html($gametags, true) . '
                </div>
                <div id="tagdropdown-container">
                    <label for="tagdropdown">Add tag:</label>
                    <select name="tagdropdown" id="tagdropdown">' . $tagoptions . '</select>
                </div>
            </div>
        </div>

        <div class="input-container" style="font-size:24px;margin-top:24px">Notes</div>
        <div class="input-container">
            <textarea id="notes" name="notes" maxlength="8192" placeholder="Enter notes about the game here">' . $game->notes . '</textarea>
        </div>

        <div class="input-container" style="margin-top:24px">
            <input type="submit" value="Submit" name="submit">
        </div>
    </form>';

    if ($type === 'edit') {
        echo '<form action="/inventory/game/action/index.php" method="post" enctype="multipart/form-data">
            <div class="input-container" style="margin-top:12px">
                <input style="color:red" type="submit" value="Delete" name="submit">
            </div>
            <input type="hidden" value="delete" name="type">
            <input type="hidden" value="' . $id . '" name="id">
        </form>';
    }
}

function get_icon_input_html(): void
{
    echo '<div class="input-container">
        <form action="/inventory/icon/upload/index.php" method="post" enctype="multipart/form-data">
            Select file:
            <input type="file" name="iconfile" id="iconfile">
            <input type="submit" value="Upload" name="submit">
        </form>
    </div>
    <div class="input-container">
        <form action="/inventory/icon/upload/index.php" method="post" enctype="multipart/form-data">
            Select multiple files (max 20):
            <input type="file" name="iconfiles[]" id="iconfiles" multiple>
            <input type="submit" value="Upload" name="submit">
        </form>
    </div>';
}
