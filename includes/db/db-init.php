<?php

function check_table_exists($connection, $table_name)
{
    return $connection->query("SHOW TABLES LIKE'" . $table_name . "'")->num_rows == 1;
}

function create_games_table($connection)
{
    include "db-config.php";
    $table_exists = check_table_exists($connection, $games_table_name);

    if (!$table_exists) {
        $query = "CREATE TABLE " . $games_table_name . " (" . $games_table_schema . ")";
        $result = $connection->query($query);
        return $result;
    } else {
        echo "Table already exists<br>";
    }
}
