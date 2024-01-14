<?php

function get_sanitized_param_num($name): int
{
    if (isset($_GET[$name])) {
        return (int)preg_replace('/[^0-9.]/', '', $_GET[$name]);
    } else {
        return 0;
    }
}

include_once '../../../includes/auth/check-auth.php';
if (!$valid_auth) {
    exit();
}

require_once '../../../includes/db/db-connection.php';
require_once '../../../includes/db/tags-table.php';
$connection = get_mysql_connection();
verify_tags_table($connection);

$id = get_sanitized_param_num('id');
delete_tag($connection, $id);

$connection->close();
header("Location: /inventory/tag/");
