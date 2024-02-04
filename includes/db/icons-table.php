<?php

function verify_icons_table(mysqli $connection): void
{
    require_once 'db-init.php';
    create_icons_table($connection);
}

function get_icon_row_by_id(mysqli $connection, $id)
{
    return $connection->query('SELECT * FROM ' . ICONS_TABLE['NAME'] . ' WHERE id=' . $id . " LIMIT 1");
}

function get_icons_table_rows(mysqli $connection, int $limit = -1, int $page = -1)
{
    $query = 'SELECT * FROM ' . ICONS_TABLE['NAME'];
    if ($limit > -1 && $page == -1) {
        $query .= ' LIMIT ' . $limit;
    } else if ($limit > -1 && $page >= 0) {
        $num_icons = $connection->query('SELECT COUNT(*) FROM ' . ICONS_TABLE['NAME'])->fetch_assoc()['COUNT(*)'];
        $_SESSION['icon_count'] = $num_icons;
        $offset = $page * $limit;
        // ensure page number not too big
        if ($offset >= $num_icons) {
            // get the last n icons
            $offset = $num_icons - $limit;
        }
        $query .= ' LIMIT ' . $offset . ',' . $limit;
    }
    return $connection->query($query);
}

function get_icon_exists(mysqli $connection, string $filename): bool
{
    return $connection->query('SELECT id FROM ' . ICONS_TABLE['NAME'] . " WHERE filename=\"" . $filename . "\"")->num_rows > 0;
}

function get_icon_add_query(mysqli $connection, string $filename): string
{
    return 'INSERT INTO ' . ICONS_TABLE['NAME'] . ' ' . ICONS_TABLE['COLUMNS'] . " VALUES (\"" . $filename . '");';
}

function add_icon(mysqli $connection, string $filename)
{
    if (get_icon_exists($connection, $filename) === false) {
        return $connection->query(get_icon_add_query($connection, $filename));
    } else {
        return false;
    }
}

function delete_icon(mysqli $connection, int $id)
{
    $icondata = get_icon_row_by_id($connection, $id);
    unlink($_SERVER['DOCUMENT_ROOT'] . '/resources/png/icon/' . $icondata->fetch_assoc()['filename']);
    
    $connection->query('UPDATE ' . GAMES_TABLE['NAME'] . ' SET iconid=0 WHERE iconid=' . $id);
    
    return $connection->query('DELETE FROM ' . ICONS_TABLE['NAME'] . " WHERE id=" . $id);
}
