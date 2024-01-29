<?php

function sanitize(string $data, string $pattern): string
{
    return preg_replace($pattern, '', $data);
}

function get_sanitized_param(string $name): string
{
    $data = $_POST[$name] ?? 'unknown';
    return sanitize($data, '/[^A-Za-z0-9 \'",.!:-]/');
}

function sanitize_csv(string $data): string
{
    return sanitize($data, '/[^A-Za-z0-9 \'",.!:-]/');
}

function get_sanitized_param_num(string $name): float
{
    $data = $_POST[$name] ?? '0';
    return (float)sanitize($data, '/[^0-9.]/');
}

function sanitize_csv_num(string $data): float
{
    return (float)sanitize($data, '/[^0-9.]/');
}

function build_game_object($title, $year, $platform, $company, $rating, $hours, $playthroughs,
                           $hundo, $plat, $dlc, $physical, $iconid, $notes, $tags): Game
{
    $game = new Game();
    $game->title = $title;
    $game->year = $year;
    $game->platform = $platform;
    $game->company = $company;
    $game->rating = $rating;
    $game->hours = $hours;
    $game->playthroughs = $playthroughs;
    $game->hundo = $hundo;
    $game->plat = $plat;
    $game->dlc = $dlc;
    $game->physical = $physical;
    $game->iconid = $iconid;
    $game->notes = $notes;
    $game->tags = $tags;
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
    $iconid = (int)get_sanitized_param_num('iconid');
    $notes = get_sanitized_param('notes');
    $tags = get_sanitized_param('tags');

    return build_game_object($title, $year, $platform, $company, $rating, $hours,
        $playthroughs, $hundo, $plat, $dlc, $physical, $iconid, $notes, $tags);
}

function get_csv_game(array $line): Game
{
    [$title, $company, $year, $platform, $rating, $hundo, $plat, , $hours, $playthroughs, $dlc, $physical] = $line;

    return build_game_object(
        sanitize_csv($title),
        (int)sanitize_csv_num($year),
        sanitize_csv($platform),
        sanitize_csv($company),
        sanitize_csv_num($rating),
        (int)sanitize_csv_num($hours),
        (int)sanitize_csv_num($playthroughs),
        (int)sanitize_csv_num($hundo) === 1,
        (int)sanitize_csv_num($plat) === 1,
        (int)sanitize_csv_num($dlc) === 1,
        (int)sanitize_csv_num($physical) === 1, 0,'','');
}

function handle_new(mysqli $connection): void
{
    $game = get_post_game();
    add_game($connection, $game);
}

function handle_edit(mysqli $connection): void
{
    if (isset($_POST['id'])) {
        $game = get_post_game();
        edit_game($connection, $game, (int)get_sanitized_param_num('id'));
    }
}

function handle_import(mysqli $connection): void
{
    if (isset($_POST['csv'])) {
        $lines = explode("\n", $_POST['csv']);
        $games = array_map('get_csv_game', array_map('str_getcsv', $lines));
        foreach ($games as $game) {
            add_game($connection, $game);
        }
    }
}

function handle_delete(mysqli $connection): void
{
    if (isset($_POST['id'])) {
        $id = (int)get_sanitized_param_num('id');
        delete_game($connection, $id);
    }
}

require '../../../includes/auth/check-auth.php';
require '../../../includes/db/db-config.php';
require '../../../includes/db/db-connection.php';
require '../../../includes/db/games-table.php';
require '../../../includes/game.php';

if (!$valid_auth) {
    exit();
}

$connection = get_mysql_connection();
verify_games_table($connection);

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    switch ($type) {
        case 'new':
            handle_new($connection);
            break;
        case 'edit':
            handle_edit($connection);
            break;
        case 'import':
            handle_import($connection);
            break;
        case 'delete':
            handle_delete($connection);
            break;
    }
}

$connection->close();
header('Location: /inventory/game/');
