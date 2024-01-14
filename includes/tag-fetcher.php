<?php

require_once 'tag.php';

function build_tag_object($data): Tag
{
    return new Tag($data['id'], $data['text']);
}

function get_all_tags(): array
{
    require_once 'db/db-connection.php';
    require_once 'db/tags-table.php';

    $tags = array();
    $connection = get_mysql_connection();
    verify_tags_table($connection);
    $rows = get_tags_table_rows($connection);
    $connection->close();

    if ($rows->num_rows == 0) {
        return $tags;
    }
    while ($row = $rows->fetch_assoc()) {
        $tags[] = build_tag_object($row);
    }

    return $tags;
}
