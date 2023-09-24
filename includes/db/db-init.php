<?php

function check_table_exists($connection, $table_name): bool
{
    return $connection->query("SHOW TABLES LIKE '" . $table_name . "'")->num_rows == 1;
}

function create_games_table($connection): bool
{
    include "db-config.php";
    if (!check_table_exists($connection, $games_table_name)) {
        $query = "CREATE TABLE " . $games_table_name . " (" . $games_table_schema . ")";
        return $connection->query($query);
    }
    return true;
}

function create_icons_table($connection): bool
{
    include "db-config.php";
    if (!check_table_exists($connection, $icons_table_name)) {
        $query = "CREATE TABLE " . $icons_table_name . " (" . $icons_table_schema . ")";
        return $connection->query($query);
    }
    return true;
}
