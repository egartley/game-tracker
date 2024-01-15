<?php

function verify_icons_table($connection): void
{
    require_once 'db-init.php';
    create_icons_table($connection);
}

function get_icon_row_by_id($connection, $id)
{
    include 'db-config.php';
    return $connection->query('SELECT * FROM ' . $icons_table_name . ' WHERE id=' . $id . " LIMIT 1");
}

function get_icons_table_rows($connection)
{
    include 'db-config.php';
    return $connection->query('SELECT * FROM ' . $icons_table_name);
}

function get_icon_exists($connection, $filename): bool
{
    include 'db-config.php';
    return $connection->query('SELECT id FROM ' . $icons_table_name . " WHERE filename=\"" . $filename . "\"")->num_rows > 0;
}

function get_icon_add_query($connection, $filename): string
{
    include 'db-config.php';
    return 'INSERT INTO ' . $icons_table_name . ' ' . $icons_table_columns . " VALUES (\"" . $filename . '");';
}

function add_icon($connection, $filename)
{
    if (get_icon_exists($connection, $filename) === false) {
        return $connection->query(get_icon_add_query($connection, $filename));
    } else {
        return false;
    }
}

function delete_icon($connection, $id)
{
    include 'db-config.php';
    
    $icondata = get_icon_row_by_id($connection, $id);
    unlink($_SERVER['DOCUMENT_ROOT'] . '/resources/png/icon/' . $icondata->fetch_assoc()['filename']);
    
    $connection->query('UPDATE ' . $games_table_name . ' SET iconid=0 WHERE iconid=' . $id);
    
    return $connection->query('DELETE FROM ' . $icons_table_name . " WHERE id=" . $id);
}
