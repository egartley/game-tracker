<?php

function get_icon_csv_listing_html($icon): string
{
    $start = '<tr>';
    $content = '<td>' . $icon->id . '</td>';
    $content .= '<td><img class="internal-icon-csv" src="/resources/png/icon/' . $icon->filename . '"></td>';
    $content .= '<td>' . $icon->filename . '</td>';
    $content .= '<td><a href="/inventory/icon/delete/?id=' . $icon->id . '">Delete</a></td>';
    $end = '</tr>';

    return $start . $content . $end;
}

function get_csv_listing_html($game, $edit_link): string
{
    $start = '<tr>';
    $content = '<td>';
    if ($edit_link) {
        $content .= '<a href="/inventory/edit/?id=' . $game->id . '">' . $game->title . '</a>';
    } else {
        $content .= $game->title;
    }
    $content .= '</td><td>' . $game->year . '</td>';
    $content .= '<td>' . $game->platform . '</td>';
    $content .= '<td>' . $game->company . '</td>';
    $content .= '<td>' . $game->rating . '</td>';
    $content .= '<td>' . $game->hours . '</td>';
    $content .= '<td>' . $game->playthroughs . '</td>';
    $content .= '<td>' . var_export($game->hundo, true) . '</td>';
    $content .= '<td>' . var_export($game->plat, true) . '</td>';
    $content .= '<td>' . var_export($game->dlc, true) . '</td>';
    $content .= '<td>' . var_export($game->physical, true) . '</td>';
    $content .= '<td>' . $game->iconid . '</td>';
    $end = '</tr>';

    return $start . $content . $end;
}

function get_compact_listing_html($game): string
{
    $iconfile = 'default-icon.png';
    if ($game->iconfile !== '') {
        $iconfile = $game->iconfile;
    }
    $start = '<div class="game-listing compact">';
    $content = '<div class="game-icon"><img src="/resources/png/icon/' . $iconfile . '"></div>';
    $content .= '<div class="game-details"><div class="game-title">';
    $content .= $game->title . '</div><div class="rating">';
    $content .= $game->get_rating_html() . '</div>';
    $content .= '<div class="subtext">' . $game->year . ', ' . $game->platform;
    $content .= '</div></div>';
    $end = '</div>';

    return $start . $content . $end;
}

function get_listing_html($type, $edit_link = false): void
{
    require_once 'game-fetcher.php';
    $html = '';
    $all_games = get_all_games();
    if ($type == 'csv') {
        $html = '<table class="csv-table"><tr>
            <th>Title</th><th>Year</th><th>Platform</th><th>Company</th><th>Rating</th>
            <th>Hours</th><th>Playthroughs</th><th>100%</th><th>Plat</th><th>DLC</th><th>Physical</th>
            <th>Icon</th></tr>';
    }

    foreach ($all_games as $game) {
        if ($type == 'compact') {
            $html .= get_compact_listing_html($game);
        } else if ($type == 'csv') {
            $html .= get_csv_listing_html($game, $edit_link);
        }
    }

    if ($type == 'csv') {
        $html .= '</table>';
    }
    echo $html;
}

function get_icon_listing_html(): void
{
    require_once 'icon-fetcher.php';
    $html = '<table class="csv-table"><tr><th>ID</th><th>Image</th><th>File Name</th><th>Actions</th></tr>';
    $all_icons = get_all_icons();
    foreach ($all_icons as $icon) {
        $html .= get_icon_csv_listing_html($icon);
    }
    $html .= '</table>';
    echo $html;
}
