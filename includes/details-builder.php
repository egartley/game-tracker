<?php

require_once 'game-fetcher.php';
require_once 'tag-fetcher.php';

function get_sanitized_param_num($name, $default = 0): float
{
    $param = $_GET[$name] ?? $default;
    return (float)preg_replace('/[^0-9]/', '', $param);
}

function get_url_game_id(): int
{
    if (isset($_GET['id'])) {
        return (int)preg_replace('/[^0-9]/', '', $_GET['id']);
    }
    return -1;
}

function get_details_html(): string
{
    $id = get_url_game_id();
    if ($id === -1) {
        return '<p>ID is required.</p>';
    }
    $game = get_game_by_id($id);
    $gametags = get_game_tags($game);
    $iconfile = $game->iconfile !== '' ? $game->iconfile : 'default-icon.png';

    $details = [
        'Title' => $game->title,
        'Year' => $game->year,
        'Company' => $game->company,
        'Platform' => $game->platform,
        'Rating' => $game->rating . ' stars',
        'Times played' => $game->playthroughs,
        'Total hours' => $game->hours,
        '100% Completion' => $game->hundo ? 'true' : 'false',
        'Platinum Trophy' => $game->plat ? 'true' : 'false',
        'DLC' => $game->dlc ? 'true' : 'false',
        'Physical Copy' => $game->physical ? 'true' : 'false'
    ];

    $html = '
    <a href="/?p=' . get_sanitized_param_num('p', 0) . '&l=' . get_sanitized_param_num('l', 10) . '" class="back-link">
        <img src="/resources/png/back-arrow.png">Back to results
    </a>
    <div class="flex details-highlight unified-container">
        <img id="game-icon" src="/resources/png/icon/' . $iconfile . '">
        <div class="details-highlight-inner">
            <div id="title">' .  $game->title . '</div>
            <div id="rating">' . $game->get_rating_html() . '</div>
            <div id="year">' .  $game->year . '</div>
            <div id="company">' .  $game->company . '</div>
            <div id="platform">' .  $game->platform . '</div>
            <div id="tags">' . $game->get_tags_html($gametags, false) . '</div>
        </div>
    </div>
    <div class="page-subtitle">Full Details</div>
    <div class="divider"></div>';

    foreach ($details as $title => $value) {
        $html .= '<div class="detail-container">
            <span class="detail-title">' . $title . ': </span>
            <span class="detail-value">' . $value . '</span>
        </div>';
    }

    if ($game->notes !== '') {
        $html .= '<div class="page-subtitle" style="margin-top:24px">Notes</div>
        <div class="divider"></div>
        <p>' . $game->notes . '</p>';
    }

    return $html;
}
