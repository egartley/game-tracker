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

function build_game_object($data, $id = -1): Game
{
    $game = new Game($data['title'], $data['year'], $data['platform'], $data['company'], $data['rating']);
    $game->id = $id === -1 ? $data['id'] : $id;
    $game->iconid = $data['iconid'];
    $game->hours = $data['hours'];
    $game->playthroughs = $data['playthroughs'];
    $game->hundo = $data['hundo'] == 1;
    $game->plat = $data['plat'] == 1;
    $game->dlc = $data['dlc'] == 1;
    $game->physical = $data['physical'] == 1;
    return $game;
}

function get_game_by_id($id): Game
{
    require_once 'db/db-connection.php';
    require_once 'db/games-table.php';

    $connection = get_mysql_connection();
    verify_games_table($connection);
    $result = get_game_row_by_id($connection, $id);
    $connection->close();

    $row = $result->fetch_assoc();
    return build_game_object($row, $id);
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
        $game = build_game_object($row);
        $game->iconfile = get_icon_filename($connection, $game->iconid);
        $games[] = $game;
    }
    $connection->close();

    return $games;
}
