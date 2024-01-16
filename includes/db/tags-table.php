<?php

function verify_tags_table($connection): void
{
    require_once 'db-init.php';
    create_tags_table($connection);
}

function get_tag_rows_by_ids($connection, $ids)
{
    include 'db-config.php';
    if ($ids == '') {
        // workaround for sql syntax error (id will never be -1, so it wont return any rows)
        $ids = "-1";
    }
    return $connection->query('SELECT * FROM ' . $tags_table_name . ' WHERE id IN(' . $ids . ')');
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
    include 'games-table.php';
    $gamerows = get_games_with_tag_by_id($connection, $id);
    if ($gamerows->num_rows > 0) {
        while ($row = $gamerows->fetch_assoc()) {
            $tags = $row['tags'];
            $newtags = '';
            if (str_contains($tags, ",")) {
                $s = explode(",", $tags);
                foreach ($s as $tag) {
                    if ($tag !== $id) {
                        $newtags .= $tag . ',';
                    }
                }
            }
            if ($newtags !== '') {
                $newtags = rtrim($newtags, ',');
            }
            $connection->query('UPDATE ' . $games_table_name . ' SET tags="' . $newtags . '" WHERE id=' . $row['id']);
        }
    }
    return $connection->query('DELETE FROM ' . $tags_table_name . " WHERE id=" . $id);
}
