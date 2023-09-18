<?php

function get_sanitized_param($name)
{
    if (isset($_GET[$name])) {
        return preg_replace('/[^A-Za-z0-9 \'",.!:-]/', '', $_GET[$name]);
    } else {
        return 'unknown';
    }
}

function get_sanitized_param_num($name)
{
    if (isset($_GET[$name])) {
        return (float) preg_replace('/[^0-9.]/', '', $_GET[$name]);
    } else {
        return 0.0;
    }
}

function get_game()
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

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    require_once '../../includes/db/db-connection.php';
    require_once '../../includes/db/games-table.php';
    require_once '../../includes/game.php';
    $connection = get_mysql_connection();
    verify_games_table($connection);

    if ($type == 'new') {
        $game = get_game();
        add_game($connection, $game);
    } else if ($type == 'edit' && isset($_GET['id'])) {
        $game = get_game();
        edit_game($connection, $game, (int) get_sanitized_param_num('id'));
    }

    $connection->close();

    if (isset($_GET['r'])) {
        if ((int) get_sanitized_param_num('r') === 1) {
            header('Location: /inventory/');
        }
    }
}
