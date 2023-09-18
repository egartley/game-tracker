<?php

function get_input_html($type)
{
    echo '<div class="input-container">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" maxlength="200">
    </div>
    <div class="input-container">
        <label for="year">Year:</label>
        <input type="text" id="year" name="year" maxlength="4">
    </div>
    <div class="input-container">
        <label for="platform">Platform:</label>
        <input type="text" id="platform" name="platform" maxlength="50">
    </div>
    <div class="input-container">
        <label for="company">Company:</label>
        <input type="text" id="company" name="company" maxlength="100">
    </div>
    <div class="input-container">
        <label for="rating">Rating:</label>
        <input type="range" id="rating" name="rating" value="0" min="0" max="5" step="0.5"
            oninput="$(\'span#ratingvalue\').html($(this).val())">
        <span id="ratingvalue">0</span>
    </div>
    <div class="input-container">
        <label for="hours">Hours:</label>
        <input type="text" id="hours" name="hours" maxlength="3">
    </div>
    <div class="input-container">
        <label for="playthroughs">Playthroughs:</label>
        <input type="text" id="playthroughs" name="playthroughs" maxlength="3">
    </div>
    <div class="input-container">
        <label for="hundo">100% Completion:</label>
        <input type="checkbox" id="hundo" name="hundo">
    </div>
    <div class="input-container">
        <label for="plat">Platinum Trophy:</label>
        <input type="checkbox" id="plat" name="plat">
    </div>
    <div class="input-container">
        <label for="dlc">DLC:</label>
        <input type="checkbox" id="dlc" name="dlc">
    </div>
    <div class="input-container">
        <label for="physical">Physical Copy:</label>
        <input type="checkbox" id="physical" name="physical">
    </div>
    <div class="input-container">
        <button class="submit" inputtype="' . $type . '">Submit</button>
    </div>';

    if ($type === 'edit' && isset($_GET['id'])) {
        require_once 'game-fetcher.php';
        $id = (int) preg_replace('/[^0-9]/', '', $_GET['id']);
        $game = get_game_by_id($id);

        echo '<div style="display:none">
        <span id="gamedata-title">' . $game->title . '</span>
        <span id="gamedata-year">' . $game->year . '</span>
        <span id="gamedata-platform">' . $game->platform . '</span>
        <span id="gamedata-company">' . $game->company . '</span>
        <span id="gamedata-rating">' . $game->rating . '</span>
        <span id="gamedata-hours">' . $game->hours . '</span>
        <span id="gamedata-playthroughs">' . $game->playthroughs . '</span>
        <span id="gamedata-hundo">' . ($game->hundo ? 1 : 0) . '</span>
        <span id="gamedata-plat">' . ($game->plat ? 1 : 0) . '</span>
        <span id="gamedata-dlc">' . ($game->dlc ? 1 : 0) . '</span>
        <span id="gamedata-physical">' . ($game->physical ? 1 : 0) . '</span>
        </div>';
    }
}
