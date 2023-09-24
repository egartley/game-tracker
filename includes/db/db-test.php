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

$table_result = create_games_table($connection);
if ($table_result) {
    echo "Games table was created successfully<br><br>";
}

require_once "games-table.php";
require_once '../game.php';
$testgame = new Game("Game Title", 2014, "PlayStation 4", "Dev Inc.", 3.5);
$testgame2 = new Game("Game Title 2", 2018, "PlayStation 4", "Dev Inc.", 3.0);
$testgame3 = new Game("Game Title 3", 2016, "PlayStation 4", "Dev Inc.", 3.0);
if (add_game($connection, $testgame)) {
    echo "Added test game 1<br><br>";
} else {
    echo "Error adding test game 1<br><br>";
}
if (add_game($connection, $testgame2)) {
    echo "Added test game 2<br><br>";
} else {
    echo "Error adding test game 2<br><br>";
}
if (add_game($connection, $testgame3)) {
    echo "Added test game 3<br><br>";
} else {
    echo "Error adding test game 3<br><br>";
}
#if (delete_game($connection, $testgame3)) {
#echo "Deleted test game 3<br><br>";
#} else {
#echo "Error deleting test game 3<br><br>";
#}

echo $connection->error;

$connection->close();
