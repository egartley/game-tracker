<?php

function get_input_html($type): void
{
    if ($type !== 'new' && !isset($_GET['id'])) {
        echo '<p>ID is required.</p>';
        return;
    }

    require_once 'game.php';
    $id = "";
    $game = new Game();
    if ($type === 'edit') {
        require_once 'game-fetcher.php';
        $id = (int)preg_replace('/[^0-9]/', '', $_GET['id']);
        $game = get_game_by_id($id);
    }

    echo '<form action="/inventory/action/index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="' . $id . '">
        <input type="hidden" name="type" value="' . $type . '">
        <!-- why do html checkboxes have to be such a pain... -->
        <input type="hidden" id="actualhundo" name="hundo" value="' . ($game->hundo ? 1 : 0) . '">
        <input type="hidden" id="actualplat" name="plat" value="' . ($game->plat ? 1 : 0) . '">
        <input type="hidden" id="actualdlc" name="dlc" value="' . ($game->dlc ? 1 : 0) . '">
        <input type="hidden" id="actualphysical" name="physical" value="' . ($game->physical ? 1 : 0) . '">

        <div class="input-container">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" maxlength="200" value="' . $game->title . '">
        </div>
        
        <div class="input-container">
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" maxlength="4" value="' . $game->year . '">
        </div>

        <div class="input-container">
            <label for="platform">Platform:</label>
            <input type="text" id="platform" name="platform" maxlength="50" value="' . $game->platform . '">
        </div>
        
        <div class="input-container">
            <label for="company">Company:</label>
            <input type="text" id="company" name="company" maxlength="100" value="' . $game->company . '">
        </div>

        <div class="input-container">
            <label for="rating">Rating:</label>
            <input type="range" id="rating" name="rating" min="0" max="5" step="0.5"
                oninput="$(\'span#ratingvalue\').html($(this).val())" value="' . $game->rating . '">
            <span id="ratingvalue">' . $game->rating . '</span>
        </div>
        
        <div class="input-container">
            <label for="hours">Hours:</label>
            <input type="text" id="hours" name="hours" maxlength="3" value="' . $game->hours . '">
        </div>
        
        <div class="input-container">
            <label for="playthroughs">Playthroughs:</label>
            <input type="text" id="playthroughs" name="playthroughs" maxlength="3" value="' . $game->playthroughs . '">
        </div>
        
        <div class="input-container">
            <label for="hundo">100% Completion:</label>
            <input type="checkbox" id="hundo" ' . ($game->hundo ? ' checked' : '') . '
                onclick="$(\'input#actualhundo\').val($(this).is(\':checked\') ? \'1\' : \'0\')">
        </div>
        
        <div class="input-container">
            <label for="plat">Platinum Trophy:</label>
            <input type="checkbox" id="plat" ' . ($game->plat ? ' checked' : '') . '
                onclick="$(\'input#actualplat\').val($(this).is(\':checked\') ? \'1\' : \'0\')">
        </div>
        
        <div class="input-container">
            <label for="dlc">DLC:</label>
            <input type="checkbox" id="dlc" ' . ($game->dlc ? ' checked' : '') . '
                onclick="$(\'input#actualdlc\').val($(this).is(\':checked\') ? \'1\' : \'0\')">
        </div>
        
        <div class="input-container">
            <label for="physical">Physical Copy:</label>
            <input type="checkbox" id="physical" ' . ($game->physical ? ' checked' : '') . '
                onclick="$(\'input#actualphysical\').val($(this).is(\':checked\') ? \'1\' : \'0\')">
        </div>
        
        <div class="input-container">
            <label for="iconid">Icon ID:</label>
            <input type="text" id="iconid" name="iconid" maxlength="6" value="' . $game->iconid . '">
        </div>

        <div class="input-container">
            <input type="submit" value="Submit" name="submit">
        </div>
    </form>';

    if ($type === 'edit') {
        echo '<form action="/inventory/action/index.php" method="post" enctype="multipart/form-data">
            <div class="input-container">
                <input type="submit" value="Delete" name="submit">
            </div>
            <input type="hidden" value="delete" name="type">
            <input type="hidden" value="' . $id . '" name="id">
        </form>';
    }
}

function get_icon_input_html($type): void
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
