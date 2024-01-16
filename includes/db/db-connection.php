<?php

function get_mysql_connection(): mysqli
{
    require "db-login.php";
    return new mysqli($db_host, $db_user, $db_pass, $db_name);
}
