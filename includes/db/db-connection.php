<?php

function get_mysql_connection()
{
    include "db-config.php";
    return new mysqli($db_host, $db_user, $db_pass, $db_schema);
}
