<?php

require_once 'game.php';

function get_temp_games()
{
    $temp_game = new Game("Game Title", 2014, "PlayStation 4", "Dev Inc.", 3.5, 200);

    return array($temp_game, $temp_game, $temp_game, $temp_game, $temp_game, $temp_game, $temp_game, $temp_game, $temp_game);
}

function get_all_games()
{
    require_once "db/db-connection.php";
    require_once "db/games-table.php";

    $games = array();
    $connection = get_mysql_connection();
    verify_games_table($connection);
    $rows = get_games_table_rows($connection);
    $connection->close();

    if ($rows->num_rows == 0) {
        return $games;
    }
    while ($row = $rows->fetch_assoc()) {
        $title = $row["title"];
        $year = $row["year"];
        $platform = $row["platform"];
        $company = $row["company"];
        $rating = $row["rating"];
        $iconid = $row["id"];
        $game = new Game($title, $year, $platform, $company, $rating, $iconid);
        $game->hours = $row["hours"];
        $game->playthroughs = $row["playthroughs"];
        $game->hundo = $row["hundo"] == 1;
        $game->plat = $row["plat"] == 1;
        $game->dlc = $row["dlc"] == 1;
        $game->physical = $row["physical"] == 1;
        array_push($games, $game);
    }

    return $games;
}
