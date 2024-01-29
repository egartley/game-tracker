<?php

function verify_games_table(mysqli $connection): void
{
    require_once 'db-init.php';
    create_games_table($connection);
}

function get_games_table_rows(mysqli $connection, int $limit = -1, int $page = -1)
{
    $query = 'SELECT * FROM ' . GAMES_TABLE['NAME'];
    if ($limit > -1 && $page == -1) {
        $query .= ' LIMIT ' . $limit;
    } else if ($limit > -1 && $page >= 0) {
        $num_games = $connection->query('SELECT COUNT(*) FROM ' . GAMES_TABLE['NAME'])->fetch_assoc()['COUNT(*)'];
        $_SESSION['game_count'] = $num_games;
        $offset = $page * $limit;
        // ensure page number not too big
        if ($offset >= $num_games) {
            // get the last n games
            $offset = $num_games - $limit;
        }
        $query .= ' LIMIT ' . $offset . ',' . $limit;
    }
    return $connection->query($query);
}

function get_game_row_by_id(mysqli $connection, int $id)
{
    return $connection->query('SELECT * FROM ' . GAMES_TABLE['NAME'] . ' WHERE id=' . $id . " LIMIT 1");
}

function get_games_with_tag_by_id(mysqli $connection, int $tagid)
{
    // X or X,* or *,X,* or *,X
    // only, first, nth, last
    return $connection->query('SELECT * FROM ' . GAMES_TABLE['NAME'] .
            ' WHERE tags LIKE "' . $tagid . '" OR tags LIKE "' . $tagid . ',%" OR tags LIKE "%,' . $tagid . ',%" OR tags LIKE "%,' . $tagid . '"');
}

function get_game_exists(mysqli $connection, Game $game): bool
{
    return $connection->query('SELECT id FROM ' . GAMES_TABLE['NAME'] . " WHERE title=\"" . $game->title
            . "\" AND year=" . $game->year . " AND platform=\"" . $game->platform . "\"")->num_rows > 0;
}

function get_game_add_query(mysqli $connection, Game $game): string
{
    $query = 'INSERT INTO ' . GAMES_TABLE['NAME'] . ' ' . GAMES_TABLE['COLUMNS'] . " VALUES (\"";
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

function add_game(mysqli $connection, Game $game)
{
    if (get_game_exists($connection, $game) === false) {
        $query = get_game_add_query($connection, $game);
        return $connection->query($query);
    } else {
        return false;
    }
}

function delete_game(mysqli $connection, $id)
{
    return $connection->query('DELETE FROM ' . GAMES_TABLE['NAME'] . ' WHERE id=' . $id);
}

function edit_game(mysqli $connection, $game, $id)
{
    if (get_game_row_by_id($connection, $id)->num_rows == 1) {
        $query = 'UPDATE ' . GAMES_TABLE['NAME'] . ' SET ';
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
