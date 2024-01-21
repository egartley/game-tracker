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
    return create_db_table($connection, GAMES_TABLE_NAME, GAMES_TABLE_SCHEMA);
}

function create_icons_table($connection): bool
{
    return create_db_table($connection, ICONS_TABLE_NAME, ICONS_TABLE_SCHEMA);
}

function create_tags_table($connection): bool
{
    return create_db_table($connection, TAGS_TABLE_NAME, TAGS_TABLE_SCHEMA);
}

function create_editor_table($connection): bool
{
    return create_db_table($connection, EDITOR_TABLE_NAME, EDITOR_TABLE_SCHEMA);
}
