<?php

function verify_editor_table($connection): void
{
    require_once 'db-init.php';
    create_editor_table($connection);
}

function get_passhash_already_set($connection): bool
{
    include 'db-config.php';
    return $connection->query('SELECT * FROM ' . $editor_table_name)->num_rows > 0;
}

function get_passhash($connection): string
{
    include 'db-config.php';
    $row = $connection->query('SELECT * FROM ' . $editor_table_name . ' LIMIT 1');
    return $row->fetch_assoc()['passhash'];
}

function get_editor_add_query($connection, $passhash): string
{
    include 'db-config.php';
    return 'INSERT INTO ' . $editor_table_name . ' ' . $editor_table_columns . " VALUES (\"" . $passhash . '");';
}

function add_editor($connection, $passhash)
{
    return $connection->query(get_editor_add_query($connection, $passhash));
}
