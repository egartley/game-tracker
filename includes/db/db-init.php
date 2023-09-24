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
        $result = $connection->query($query);
        return $result;
    }
    return true;
}
