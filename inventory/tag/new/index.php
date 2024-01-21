<?php

function get_sanitized_param($name): array|string|null
{
    if (isset($_POST[$name])) {
        return preg_replace('/[^A-Za-z0-9 \'",.!:-]/', '', $_POST[$name]);
    } else {
        return 'unknown';
    }
}

require '../../../includes/auth/check-auth.php';
if (!$valid_auth) {
    exit();
}

if (isset($_POST['text'])) {
    require '../../../includes/db/db-connection.php';
    require '../../../includes/db/tags-table.php';
    $connection = get_mysql_connection();
    verify_tags_table($connection);
    add_tag($connection, get_sanitized_param('text'));
    $connection->close();
}

header('Location: /inventory/tag/');
