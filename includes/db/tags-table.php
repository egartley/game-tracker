<?php

function verify_tags_table($connection): void
{
    require_once 'db-init.php';
    create_tags_table($connection);
}

function get_tag_row_by_id($connection, $id)
{
    include 'db-config.php';
    return $connection->query('SELECT * FROM ' . $tags_table_name . ' WHERE id=' . $id . " LIMIT 1");
}

function get_tags_table_rows($connection)
{
    include 'db-config.php';
    return $connection->query('SELECT * FROM ' . $tags_table_name);
}

function get_tag_exists($connection, $text): bool
{
    include 'db-config.php';
    return $connection->query('SELECT id FROM ' . $tags_table_name . " WHERE text=\"" . $text . "\"")->num_rows > 0;
}

function get_tag_add_query($connection, $text): string
{
    include 'db-config.php';
    return 'INSERT INTO ' . $tags_table_name . ' ' . $tags_table_columns . " VALUES (\"" . $text . '");';
}

function add_tag($connection, $text)
{
    if (get_tag_exists($connection, $text) === false) {
        return $connection->query(get_tag_add_query($connection, $text));
    } else {
        return false;
    }
}

function delete_tag($connection, $id)
{
    include 'db-config.php';
    return $connection->query('DELETE FROM ' . $tags_table_name . " WHERE id=" . $id);
}
