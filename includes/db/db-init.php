<?php

function check_table_exists($connection, $table_name): bool
{
    return $connection->query("SHOW TABLES LIKE '" . $table_name . "'")->num_rows == 1;
}

function create_db_table($connection, $name, $schema): bool
{
    if (!check_table_exists($connection, $name)) {
        $query = "CREATE TABLE " . $name . " (" . $schema . ")";
        return $connection->query($query);
    }
    return true;
}

function create_games_table($connection): bool
{
    include "db-config.php";
    return create_db_table($connection, $games_table_name, $games_table_schema);
}

function create_icons_table($connection): bool
{
    include "db-config.php";
    return create_db_table($connection, $icons_table_name, $icons_table_schema);
}

function create_tags_table($connection): bool
{
    include "db-config.php";
    return create_db_table($connection, $tags_table_name, $tags_table_schema);
}

function create_editor_table($connection): bool
{
    include "db-config.php";
    return create_db_table($connection, $editor_table_name, $editor_table_schema);
}
