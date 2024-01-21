<?php

function get_sanitized_param_num($name): int
{
    if (isset($_GET[$name])) {
        return (int)preg_replace('/[^0-9.]/', '', $_GET[$name]);
    } else {
        return 0;
    }
}

require '../../../includes/auth/check-auth.php';
if (!$valid_auth) {
    exit();
}

require '../../../includes/db/db-connection.php';
require '../../../includes/db/icons-table.php';
$connection = get_mysql_connection();
verify_icons_table($connection);

$id = get_sanitized_param_num('id');
delete_icon($connection, $id);

$connection->close();
header("Location: /inventory/icon/");
