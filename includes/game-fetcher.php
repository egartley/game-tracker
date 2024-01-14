<?php

require_once 'game.php';

function get_icon_filename($connection, $iconid)
{
    require_once 'db/icons-table.php';
    verify_icons_table($connection);
    $row = get_icon_row_by_id($connection, $iconid);
    if ($row->num_rows == 0) {
        return '';
    }
    return $row->fetch_assoc()['filename'];
}

function build_game_object($connection, $data, $id = -1): Game
{
    $game = new Game();
    $game->title = $data['title'];
    $game->year = $data['year'];
    $game->platform = $data['platform'];
    $game->company = $data['company'];
    $game->rating = $data['rating'];
    $game->id = $id === -1 ? $data['id'] : $id;
    $game->iconid = $data['iconid'];
    $game->hours = $data['hours'];
    $game->playthroughs = $data['playthroughs'];
    $game->hundo = $data['hundo'] == 1;
    $game->plat = $data['plat'] == 1;
    $game->dlc = $data['dlc'] == 1;
    $game->physical = $data['physical'] == 1;
    $game->iconfile = get_icon_filename($connection, $game->iconid);
    $game->notes = $data['notes'];
    return $game;
}

function get_game_by_id($id): Game
{
    require_once 'db/db-connection.php';
    require_once 'db/games-table.php';

    $connection = get_mysql_connection();
    verify_games_table($connection);
    $result = get_game_row_by_id($connection, $id);
    
    $row = $result->fetch_assoc();
    $game = build_game_object($connection, $row, $id);
    
    $connection->close();
    return $game;
}

function get_all_games(): array
{
    require_once 'db/db-connection.php';
    require_once 'db/games-table.php';

    $games = array();
    $connection = get_mysql_connection();
    verify_games_table($connection);
    $rows = get_games_table_rows($connection);
    if ($rows->num_rows == 0) {
        return $games;
    }

    while ($row = $rows->fetch_assoc()) {
        $games[] = build_game_object($connection, $row);
    }

    $connection->close();
    return $games;
}
