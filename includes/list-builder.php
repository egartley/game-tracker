<?php

require_once 'game-fetcher.php';

function get_csv_listing_html($game)
{
    $start = "<tr>";
    $content = "<td>" . $game->iconid . "</td>";
    $content .= "<td>" . $game->title . "</td>";
    $content .= "<td>" . $game->year . "</td>";
    $content .= "<td>" . $game->platform . "</td>";
    $content .= "<td>" . $game->company . "</td>";
    $content .= "<td>" . $game->rating . "</td>";
    $content .= "<td>" . $game->hours . "</td>";
    $content .= "<td>" . $game->playthroughs . "</td>";
    $content .= "<td>" . var_export($game->hundo, true) . "</td>";
    $content .= "<td>" . var_export($game->plat, true) . "</td>";
    $content .= "<td>" . var_export($game->dlc, true) . "</td>";
    $content .= "<td>" . var_export($game->physical, true) . "</td>";
    $end = "</tr>";
    
    return $start . $content . $end;
}

function get_compact_listing_html($game)
{
    $start = '<div class="game-listing compact">';
    $content = '<div class="game-icon"><img src="/resources/png/default-icon.png"></div>';
    $content .= '<div class="game-details"><div class="game-title">';
    $content .= $game->title . '</div><div class="rating">';
    $content .= $game->get_rating_html() . "</div>";
    $content .= '<div class="subtext">' . $game->year . ", " . $game->platform;
    $content .= "</div></div>";
    $end = "</div>";

    return $start . $content . $end;
}

function get_listing_html($type)
{
    $html = "";
    $all_games = get_all_games();
    if ($type == "csv") {
        $html = '<table class="csv-table"><tr>
            <th>ID</th><th>Title</th><th>Year</th><th>Platform</th><th>Company</th><th>Rating</th>
            <th>Hours</th><th>Playthroughs</th><th>100%</th><th>Platinum</th><th>DLC</th><th>Physical</th></tr>';
    }

    foreach ($all_games as $game) {
        if ($type == "compact") {
            $html .= get_compact_listing_html($game);
        } else if ($type == "csv") {
            $html .= get_csv_listing_html($game);
        }
    }

    if ($type == "csv") {
        $html .= "</table>";
    }
    echo $html;
}

function get_temp_listing_html($type)
{
    $html = "";
    $all_games = get_temp_games();
    if ($type == "csv") {
        $html = '<table class="csv-table"><tr>
            <th>ID</th><th>Title</th><th>Year</th><th>Platform</th><th>Company</th><th>Rating</th>
            <th>Hours</th><th>Playthroughs</th><th>100%</th><th>Platinum</th><th>DLC</th><th>Physical</th></tr>';
    }

    foreach ($all_games as $game) {
        if ($type == "compact") {
            $html .= get_compact_listing_html($game);
        } else if ($type == "csv") {
            $html .= get_csv_listing_html($game);
        }
    }

    if ($type == "csv") {
        $html .= "</table>";
    }
    echo $html;
}
