<?php

function verify_editor_table(mysqli $connection): void
{
    require_once 'db-init.php';
    create_editor_table($connection);
}

function get_passhash_already_set(mysqli $connection): bool
{
    return $connection->query('SELECT * FROM ' . EDITOR_TABLE['NAME'])->num_rows > 0;
}

function get_passhash(mysqli $connection): string
{
    $row = $connection->query('SELECT * FROM ' . EDITOR_TABLE['NAME'] . ' LIMIT 1');
    return $row->fetch_assoc()['passhash'];
}

function get_editor_add_query(mysqli $connection, string $passhash): string
{
    return 'INSERT INTO ' . EDITOR_TABLE['NAME'] . ' ' . EDITOR_TABLE['COLUMNS'] . " VALUES (\"" . $passhash . '");';
}

function add_editor(mysqli $connection, string $passhash)
{
    return $connection->query(get_editor_add_query($connection, $passhash));
}
