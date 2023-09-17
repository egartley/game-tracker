<?php

function get_game_exists($connection, $game)
{
    include "db-config.php";
    return $connection->query("SELECT * FROM " . $games_table_name . " WHERE id=" . $game->iconid)->num_rows > 0;
}

function add_game($connection, $game)
{
    include "db-config.php";
    if (get_game_exists($connection, $game) === false) {
        $query = "INSERT INTO " . $games_table_name . " " . $games_table_columns . " VALUES (";
        $query .= $game->iconid . ", '";
        $query .= $game->title . "', ";
        $query .= $game->year . ", '";
        $query .= $game->platform . "', '";
        $query .= $game->company . "', ";
        $query .=  $game->rating . ", ";
        $query .=  $game->hours . ", ";
        $query .=  $game->playthroughs . ", ";
        $query .=  ($game->hundo ? 1 : 0) . ", ";
        $query .=  ($game->plat ? 1 : 0) . ", ";
        $query .=  ($game->dlc ? 1 : 0) . ", ";
        $query .=  ($game->physical ? 1 : 0) . ")";
        return $connection->query($query);
    } else {
        return false;
    }
}

function delete_game($connection, $game)
{
    include "db-config.php";
    if (get_game_exists($connection, $game)) {
        return $connection->query("DELETE FROM " . $games_table_name . " WHERE id=" . $game->iconid);
    } else {
        return false;
    }
}
