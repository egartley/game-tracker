<?php

function verify_editor_table($connection): void
{
    require_once 'db-init.php';
    create_editor_table($connection);
}

function get_passhash_already_set($connection): bool
{
    return $connection->query('SELECT * FROM ' . EDITOR_TABLE_NAME)->num_rows > 0;
}

function get_passhash($connection): string
{
    $row = $connection->query('SELECT * FROM ' . EDITOR_TABLE_NAME . ' LIMIT 1');
    return $row->fetch_assoc()['passhash'];
}

function get_editor_add_query($connection, $passhash): string
{
    return 'INSERT INTO ' . EDITOR_TABLE_NAME . ' ' . EDITOR_TABLE_COLUMNS . " VALUES (\"" . $passhash . '");';
}

function add_editor($connection, $passhash)
{
    return $connection->query(get_editor_add_query($connection, $passhash));
}
