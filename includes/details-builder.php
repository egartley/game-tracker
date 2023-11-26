<?php

function get_details_html()
{
    if (!isset($_GET['id'])) {
        echo '<p>ID is required.</p>';
        return;
    }
    require_once '../includes/game-fetcher.php';
    $id = (int)preg_replace('/[^0-9]/', '', $_GET['id']);
    $game = get_game_by_id($id);

    $iconfile = 'default-icon.png';
    if ($game->iconfile !== '') {
        $iconfile = $game->iconfile;
    }
    echo '<a href="/" class="back-link"><img src="/resources/png/back-arrow.png">Back to results</a>
    <div class="flex details-highlight unified-container">
        <img id="game-icon" src="/resources/png/icon/' . $iconfile . '">
        <div class="details-highlight-inner">
            <div id="title">' .  $game->title . '</div>
            <div id="rating">' . $game->get_rating_html() . '</div>
            <div id="year">' .  $game->year . '</div>
            <div id="company">' .  $game->company . '</div>
            <div id="platform">' .  $game->platform . '</div>
        </div>
    </div>';
    echo '<div class="page-subtitle">Full Details</div>
    <div class="divider"></div>
    <div class="detail-container">
        <span class="detail-title">Title: </span>
        <span class="detail-value">' . $game->title . '</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">Year: </span>
        <span class="detail-value">' . $game->year . '</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">Company: </span>
        <span class="detail-value">' . $game->company . '</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">Platform: </span>
        <span class="detail-value">' . $game->platform . '</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">Rating: </span>
        <span class="detail-value">' . $game->rating . ' stars</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">Times played: </span>
        <span class="detail-value">' . $game->playthroughs . '</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">Total hours: </span>
        <span class="detail-value">' . $game->hours . '</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">100% Completion: </span>
        <span class="detail-value">' . ($game->hundo ? 'true' : 'false') . '</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">Platinum Trophy: </span>
        <span class="detail-value">' . ($game->plat ? 'true' : 'false') . '</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">DLC: </span>
        <span class="detail-value">' . ($game->dlc ? 'true' : 'false') . '</span>
    </div>
    <div class="detail-container">
        <span class="detail-title">Physical Copy: </span>
        <span class="detail-value">' . ($game->physical ? 'true' : 'false') . '</span>
    </div>';
}
