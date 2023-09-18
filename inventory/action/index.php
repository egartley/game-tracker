<?php

function get_sanitized_param($name)
{
    if (isset($_GET[$name])) {
        return preg_replace('/[^A-Za-z0-9 \'",.!:-]/', '', $_GET[$name]);
    } else {
        return 'unknown';
    }
}

function sanitize_csv($data)
{
    return preg_replace('/[^A-Za-z0-9 \'",.!:-]/', '', $data);
}

function get_sanitized_param_num($name)
{
    if (isset($_GET[$name])) {
        return (float) preg_replace('/[^0-9.]/', '', $_GET[$name]);
    } else {
        return 0.0;
    }
}

function sanitize_csv_num($data)
{
    return (float) preg_replace('/[^0-9.]/', '', $data);
}

function get_url_game()
{
    $title = get_sanitized_param('title');
    $year = (int) get_sanitized_param_num('year');
    $platform = get_sanitized_param('platform');
    $company = get_sanitized_param('company');
    $rating = get_sanitized_param_num('rating');
    $hours = (int) get_sanitized_param_num('hours');
    $playthroughs = (int) get_sanitized_param_num('playthroughs');
    $hundo = (int) get_sanitized_param_num('hundo') === 1;
    $plat = (int) get_sanitized_param_num('plat') === 1;
    $dlc = (int) get_sanitized_param_num('dlc') === 1;
    $physical = (int) get_sanitized_param_num('physical') === 1;

    $game = new Game($title, $year, $platform, $company, $rating);
    $game->hours = $hours;
    $game->playthroughs = $playthroughs;
    $game->hundo = $hundo;
    $game->plat = $plat;
    $game->dlc = $dlc;
    $game->physical = $physical;

    return $game;
}

function get_csv_game($line)
{
    $title = sanitize_csv($line[0]);
    $year = (int) sanitize_csv_num($line[2]);
    $platform = sanitize_csv($line[3]);
    $company = sanitize_csv($line[1]);
    $rating = sanitize_csv_num($line[4]);
    $hours = (int) sanitize_csv_num($line[8]);
    $playthroughs = (int) sanitize_csv_num($line[9]);
    $hundo = (int) sanitize_csv_num($line[5]) === 1;
    $plat = (int) sanitize_csv_num($line[6]) === 1;
    $dlc = (int) sanitize_csv_num($line[10]) === 1;
    $physical = (int) sanitize_csv_num($line[11]) === 1;

    $game = new Game($title, $year, $platform, $company, $rating);
    $game->hours = $hours;
    $game->playthroughs = $playthroughs;
    $game->hundo = $hundo;
    $game->plat = $plat;
    $game->dlc = $dlc;
    $game->physical = $physical;

    return $game;
}

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    require_once '../../includes/db/db-connection.php';
    require_once '../../includes/db/games-table.php';
    require_once '../../includes/game.php';
    $connection = get_mysql_connection();
    verify_games_table($connection);

    if ($type == 'new') {
        $game = get_url_game();
        add_game($connection, $game);
    } else if ($type == 'edit' && isset($_GET['id'])) {
        $game = get_url_game();
        edit_game($connection, $game, (int) get_sanitized_param_num('id'));
    }

    $connection->close();

    if (isset($_GET['r'])) {
        if ((int) get_sanitized_param_num('r') === 1) {
            header('Location: /inventory/');
        }
    }
} else if (isset($_POST['type'])) {
    $type = $_POST['type'];

    if ($type == 'import' && isset($_POST['csv'])) {
        $lines = explode("\n", $_POST['csv']);
        $array = array();
        foreach ($lines as $line) {
            $array[] = str_getcsv($line);
        }

        $games = array();
        require_once '../../includes/game.php';
        foreach ($array as $line) {
            $game = get_csv_game($line);
            array_push($games, $game);
        }

        require_once '../../includes/db/db-connection.php';
        require_once '../../includes/db/games-table.php';
        $connection = get_mysql_connection();
        verify_games_table($connection);
        foreach ($games as $game) {
            add_game($connection, $game);
        }
        $connection->close();
    }
}
