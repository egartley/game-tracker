<?php

function get_mysql_connection(): mysqli
{
    include_once "db-login.php";
    return new mysqli($db_host, $db_user, $db_pass, $db_name);
}
