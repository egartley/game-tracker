<?php

require_once 'game-fetcher.php';

function get_compact_listing_html($game)
{
    $start = '<div class="game-listing compact">';
    $content = '<div class="game-icon"><img src="/resources/png/default-icon.png"></div>';
    $content = $content . '<div class="game-details"><div class="game-title">';
    $content = $content . $game->title . '</div><div class="rating">';
    $content = $content . $game->get_rating_html() . "</div>";
    $content = $content . '<div class="subtext">' . $game->year . ", " . $game->platform;
    $content = $content . "</div></div>";
    $end = "</div>";

    return $start . $content . $end;
}

function get_listing_html($type)
{
    $html = "";
    $all_games = get_temp_games();
    foreach ($all_games as $game) {
        if ($type == "compact") {
            $html = $html . get_compact_listing_html($game);
        }
    }
    echo $html;
}