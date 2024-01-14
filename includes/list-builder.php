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

function get_tag_csv_listing_html($tag): string
{
    $content = '<tr><td>' . $tag->id . '</td>';
    $content .= '<td>' . $tag->text . '</td>';
    $content .= '<td><a href="/inventory/tag/delete/?id=' . $tag->id . '">Delete</a></td></tr>';

    return $content;
}

function get_csv_listing_html($game, $edit_link): string
{
    $start = '<tr>';
    $content = '<td>';
    if ($edit_link) {
        $content .= '<a href="/inventory/game/edit/?id=' . $game->id . '">' . $game->title . '</a>';
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
    $start = '<div class="game-listing compact" onclick="window.location.href=\'/game/?id=' . $game->id . '\'">';
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

function get_icon_grid_html($icon, $gameid)
{
    $start = '<div>';
    $content = '<a href="/inventory/game/edit/?id=' . $gameid . '&icon=' . $icon->id . '&file=' . $icon->filename . '">';
    if ($gameid === 'new') {
        $content = '<a href="/inventory/game/new/?icon=' . $icon->id . '&file=' . $icon->filename . '">';
    }
    $content .= '<img class="icon-grid-icon" src="/resources/png/icon/' . $icon->filename . '">';
    $end = '</a></div>';

    return $start . $content . $end;
}

function get_icon_listing_html($type = 'default', $gameid = -1): void
{
    require_once 'icon-fetcher.php';
    $all_icons = get_all_icons();
    if ($type === 'default') {
        $html = '<table class="csv-table"><tr><th>ID</th><th>Image</th><th>File Name</th><th>Actions</th></tr>';
        foreach ($all_icons as $icon) {
            $html .= get_icon_csv_listing_html($icon);
        }
        $html .= '</table>';
        echo $html;
    } else if ($type === 'grid' && $gameid !== -1) {
        $html = '';
        foreach ($all_icons as $icon) {
            $html .= get_icon_grid_html($icon, $gameid);
        }
        echo $html;
    } else {
        echo '<p>Invalid icon listing parameters!</p>';
    }
}

function get_tag_listing_html(): void
{
    require_once 'tag-fetcher.php';
    $all_tags = get_all_tags();
    $html = '<table class="csv-table"><tr><th>ID</th><th>Text</th><th>Actions</th></tr>';
    foreach ($all_tags as $tag) {
        $html .= get_tag_csv_listing_html($tag);
    }
    $html .= '</table>';
    echo $html;
}
