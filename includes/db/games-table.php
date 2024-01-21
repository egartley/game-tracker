<?php

function verify_games_table($connection): void
{
    require_once 'db-init.php';
    create_games_table($connection);
}

function get_games_table_rows($connection)
{
    return $connection->query('SELECT * FROM ' . GAMES_TABLE_NAME);
}

function get_game_row_by_id($connection, $id)
{
    return $connection->query('SELECT * FROM ' . GAMES_TABLE_NAME . ' WHERE id=' . $id . " LIMIT 1");
}

function get_games_with_tag_by_id($connection, $tagid)
{
    // X or X,* or *,X,* or *,X
    // only, first, nth, last
    return $connection->query('SELECT * FROM ' . GAMES_TABLE_NAME .
            ' WHERE tags LIKE "' . $tagid . '" OR tags LIKE "' . $tagid . ',%" OR tags LIKE "%,' . $tagid . ',%" OR tags LIKE "%,' . $tagid . '"');
}

function get_game_exists($connection, $game): bool
{
    return $connection->query('SELECT id FROM ' . GAMES_TABLE_NAME . " WHERE title=\"" . $game->title
            . "\" AND year=" . $game->year . " AND platform=\"" . $game->platform . "\"")->num_rows > 0;
}

function get_game_add_query($connection, $game): string
{
    $query = 'INSERT INTO ' . GAMES_TABLE_NAME . ' ' . GAMES_TABLE_COLUMNS . " VALUES (\"";
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
    $query .= ($game->physical ? 1 : 0) . ', ';
    $query .= $game->iconid . ", \"";
    $query .= $game->notes . "\", \"";
    $query .= $game->tags . "\");";
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

function delete_game($connection, $id)
{
    return $connection->query('DELETE FROM ' . GAMES_TABLE_NAME . ' WHERE id=' . $id);
}

function edit_game($connection, $game, $id)
{
    if (get_game_row_by_id($connection, $id)->num_rows == 1) {
        $query = 'UPDATE ' . GAMES_TABLE_NAME . ' SET ';
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
        $query .= 'physical=' . ($game->physical ? 1 : 0) . ', ';
        $query .= 'iconid=' . $game->iconid . ', ';
        $query .= "notes=\"" . $game->notes . "\", ";
        $query .= "tags=\"" . $game->tags . "\"";
        $query .= ' WHERE id=' . $id;
        return $connection->query($query);
    } else {
        return false;
    }
}
