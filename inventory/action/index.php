<?php

function get_sanitized_param($name): array|string|null
{
    if (isset($_POST[$name])) {
        return preg_replace('/[^A-Za-z0-9 \'",.!:-]/', '', $_POST[$name]);
    } else {
        return 'unknown';
    }
}

function sanitize_csv($data): array|string|null
{
    return preg_replace('/[^A-Za-z0-9 \'",.!:-]/', '', $data);
}

function get_sanitized_param_num($name): float
{
    if (isset($_POST[$name])) {
        return (float)preg_replace('/[^0-9.]/', '', $_POST[$name]);
    } else {
        return 0.0;
    }
}

function sanitize_csv_num($data): float
{
    return (float)preg_replace('/[^0-9.]/', '', $data);
}

function build_game_object($title, $year, $platform, $company, $rating, $hours, $playthroughs,
                           $hundo, $plat, $dlc, $physical): Game
{
    $game = new Game($title, $year, $platform, $company, $rating);
    $game->hours = $hours;
    $game->playthroughs = $playthroughs;
    $game->hundo = $hundo;
    $game->plat = $plat;
    $game->dlc = $dlc;
    $game->physical = $physical;
    return $game;
}

function get_post_game(): Game
{
    $title = get_sanitized_param('title');
    $year = (int)get_sanitized_param_num('year');
    $platform = get_sanitized_param('platform');
    $company = get_sanitized_param('company');
    $rating = get_sanitized_param_num('rating');
    $hours = (int)get_sanitized_param_num('hours');
    $playthroughs = (int)get_sanitized_param_num('playthroughs');
    $hundo = (int)get_sanitized_param_num('hundo') === 1;
    $plat = (int)get_sanitized_param_num('plat') === 1;
    $dlc = (int)get_sanitized_param_num('dlc') === 1;
    $physical = (int)get_sanitized_param_num('physical') === 1;

    return build_game_object($title, $year, $platform, $company, $rating, $hours,
        $playthroughs, $hundo, $plat, $dlc, $physical);
}

function get_csv_game($line): Game
{
    $title = sanitize_csv($line[0]);
    $year = (int)sanitize_csv_num($line[2]);
    $platform = sanitize_csv($line[3]);
    $company = sanitize_csv($line[1]);
    $rating = sanitize_csv_num($line[4]);
    $hours = (int)sanitize_csv_num($line[8]);
    $playthroughs = (int)sanitize_csv_num($line[9]);
    $hundo = (int)sanitize_csv_num($line[5]) === 1;
    $plat = (int)sanitize_csv_num($line[6]) === 1;
    $dlc = (int)sanitize_csv_num($line[10]) === 1;
    $physical = (int)sanitize_csv_num($line[11]) === 1;

    return build_game_object($title, $year, $platform, $company, $rating, $hours,
        $playthroughs, $hundo, $plat, $dlc, $physical);
}

if (isset($_POST['type'])) {
    $type = $_POST['type'];

    require_once '../../includes/db/db-connection.php';
    require_once '../../includes/db/games-table.php';
    require_once '../../includes/game.php';
    $connection = get_mysql_connection();
    verify_games_table($connection);

    if ($type == 'new') {
        $game = get_post_game();
        add_game($connection, $game);
    } else if ($type == 'edit' && isset($_POST['id'])) {
        $game = get_post_game();
        edit_game($connection, $game, (int)get_sanitized_param_num('id'));
    } else if ($type == 'import' && isset($_POST['csv'])) {
        $lines = explode("\n", $_POST['csv']);
        $array = array();
        $games = array();
        foreach ($lines as $line) {
            $array[] = str_getcsv($line);
        }
        foreach ($array as $line) {
            $game = get_csv_game($line);
            $games[] = $game;
        }
        foreach ($games as $game) {
            add_game($connection, $game);
        }
    } else if ($type == 'delete' && isset($_POST['id'])) {
        $id = (int)get_sanitized_param_num('id');
        delete_game($connection, $id);
    }

    $connection->close();
}
