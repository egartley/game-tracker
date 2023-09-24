<?php

require_once "db-connection.php";
require_once "db-init.php";

$connection = get_mysql_connection();
if ($connection->connect_error) {
    echo "There was an error while attempting to connect<br>";
    echo $connection->connect_error;
    $connection->close();
    die();
} else {
    echo "MySQL connection was successful<br><br>";
}

$table_result = create_icons_table($connection);
if ($table_result) {
    echo "Icons table was created successfully<br><br>";
}

echo $connection->error;

$connection->close();
