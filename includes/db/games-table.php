<?php

function verify_games_table($connection)
{
    require_once 'db-init.php';
    create_games_table($connection);
}

function get_games_table_rows($connection)
{
    include 'db-config.php';
    return $connection->query('SELECT * FROM ' . $games_table_name);
}

function get_next_id($connection)
{
    include 'db-config.php';
    if ($connection->query('SELECT * FROM ' . $games_table_name . ' LIMIT 1')->num_rows == 0) {
        return 0;
    } else {
        return 1 + $connection->query('SELECT MAX(id) FROM ' . $games_table_name)->fetch_column();
    }
}

function get_game_exists($connection, $game)
{
    include 'db-config.php';
    return $connection->query('SELECT id FROM ' . $games_table_name . " WHERE title='" . $game->title
        . "' AND year=" . $game->year . " AND platform='" . $game->platform . "'")->num_rows > 0;
}

function add_game($connection, $game)
{
    include 'db-config.php';
    if (get_game_exists($connection, $game) === false) {
        $id = get_next_id($connection);
        $game->iconid = $id;
        $query = 'INSERT INTO ' . $games_table_name . ' ' . $games_table_columns . ' VALUES (';
        $query .= $id . ", '";
        $query .= $game->title . "', ";
        $query .= $game->year . ", '";
        $query .= $game->platform . "', '";
        $query .= $game->company . "', ";
        $query .= $game->rating . ', ';
        $query .= $game->hours . ', ';
        $query .= $game->playthroughs . ', ';
        $query .= ($game->hundo ? 1 : 0) . ', ';
        $query .= ($game->plat ? 1 : 0) . ', ';
        $query .= ($game->dlc ? 1 : 0) . ', ';
        $query .= ($game->physical ? 1 : 0) . ')';
        return $connection->query($query);
    } else {
        return false;
    }
}

function delete_game($connection, $game)
{
    include 'db-config.php';
    if (get_game_exists($connection, $game)) {
        return $connection->query('DELETE FROM ' . $games_table_name . ' WHERE id=' . $game->iconid);
    } else {
        return false;
    }
}
