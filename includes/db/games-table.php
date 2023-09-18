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

function get_game_row_by_id($connection, $id)
{
    include 'db-config.php';
    return $connection->query('SELECT * FROM ' . $games_table_name . ' WHERE id=' . $id . " LIMIT 1");
}

function get_game_exists($connection, $game)
{
    include 'db-config.php';
    return $connection->query('SELECT id FROM ' . $games_table_name . " WHERE title=\"" . $game->title
        . "\" AND year=" . $game->year . " AND platform=\"" . $game->platform . "\"")->num_rows > 0;
}

function get_game_add_query($connection, $game)
{
    include 'db-config.php';
    $query = 'INSERT INTO ' . $games_table_name . ' ' . $games_table_columns . " VALUES (\"";
    $query .= $game->title . "\", ";
    $query .= $game->year . ", \"";
    $query .= $game->platform . "\", \"";
    $query .= $game->company . "\", ";
    $query .= $game->rating . ', ';
    $query .= $game->hours . ', ';
    $query .= $game->playthroughs . ', ';
    $query .= ($game->hundo ? 1 : 0) . ', ';
    $query .= ($game->plat ? 1 : 0) . ', ';
    $query .= ($game->dlc ? 1 : 0) . ', ';
    $query .= ($game->physical ? 1 : 0) . ');';
    return $query;
}

function add_game($connection, $game)
{
    if (get_game_exists($connection, $game) === false) {
        $query = get_game_add_query($connection, $game);
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

function edit_game($connection, $game, $id)
{
    include 'db-config.php';
    if (get_game_row_by_id($connection, $id)->num_rows == 1) {
        $query = 'UPDATE ' . $games_table_name . ' SET ';
        $query .= "title=\"" . $game->title . "\", ";
        $query .= 'year=' . $game->year . ', ';
        $query .= "platform=\"" . $game->platform . "\", ";
        $query .= "company=\"" . $game->company . "\", ";
        $query .= 'rating=' . $game->rating . ', ';
        $query .= 'hours=' . $game->hours . ', ';
        $query .= 'playthroughs=' . $game->playthroughs . ', ';
        $query .= 'hundo=' . ($game->hundo ? 1 : 0) . ', ';
        $query .= 'plat=' . ($game->plat ? 1 : 0) . ', ';
        $query .= 'dlc=' . ($game->dlc ? 1 : 0) . ', ';
        $query .= 'physical=' . ($game->physical ? 1 : 0);
        $query .= ' WHERE id=' . $id;
        return $connection->query($query);
    } else {
        return false;
    }
}
