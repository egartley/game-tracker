<?php

function verify_tags_table($connection): void
{
    require_once 'db-init.php';
    create_tags_table($connection);
}

function get_tag_rows_by_ids($connection, $ids)
{
    if ($ids == '') {
        // workaround for sql syntax error (id will never be -1, so it wont return any rows)
        $ids = "-1";
    }
    return $connection->query('SELECT * FROM ' . TAGS_TABLE_NAME . ' WHERE id IN(' . $ids . ')');
}

function get_tag_row_by_id($connection, $id)
{
    return $connection->query('SELECT * FROM ' . TAGS_TABLE_NAME . ' WHERE id=' . $id . " LIMIT 1");
}

function get_tags_table_rows($connection)
{
    return $connection->query('SELECT * FROM ' . TAGS_TABLE_NAME);
}

function get_tag_exists($connection, $text): bool
{
    return $connection->query('SELECT id FROM ' . TAGS_TABLE_NAME . " WHERE text=\"" . $text . "\"")->num_rows > 0;
}

function get_tag_add_query($connection, $text): string
{
    return 'INSERT INTO ' . TAGS_TABLE_NAME . ' ' . TAGS_TABLE_COLUMNS . " VALUES (\"" . $text . '");';
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
    require 'games-table.php';
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
            $connection->query('UPDATE ' . GAMES_TABLE_NAME . ' SET tags="' . $newtags . '" WHERE id=' . $row['id']);
        }
    }
    return $connection->query('DELETE FROM ' . TAGS_TABLE_NAME . " WHERE id=" . $id);
}
