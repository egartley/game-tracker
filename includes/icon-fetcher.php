<?php

require_once 'icon.php';
require_once 'db/db-connection.php';
require_once 'db/icons-table.php';

function build_icon_object(array $data): Icon
{
    return new Icon($data['id'], $data['filename']);
}

function get_all_icons(): array
{
    $icons = array();
    $connection = get_mysql_connection();
    verify_icons_table($connection);
    $rows = get_icons_table_rows($connection);
    $connection->close();

    if ($rows->num_rows == 0) {
        return $icons;
    }
    while ($row = $rows->fetch_assoc()) {
        $icons[] = build_icon_object($row);
    }

    return $icons;
}
