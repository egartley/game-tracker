<?php

$db_host = "localhost";
$db_user = "gt-user";
$db_pass = "testpassword789";
$db_schema = "gametracker-db";

$games_table_name = "games";
$icons_table_name = "icons";

$games_table_schema = "
id INT(6) NOT NULL PRIMARY KEY,
title VARCHAR(200) NOT NULL DEFAULT '',
year INT(4) NOT NULL DEFAULT 0,
platform VARCHAR(50) NOT NULL DEFAULT '',
company VARCHAR(100) NOT NULL DEFAULT '',
rating DOUBLE NOT NULL DEFAULT 0.0,
hours INT(3) NOT NULL DEFAULT 0,
playthroughs INT(3) NOT NULL DEFAULT 0,
hundo BOOLEAN NOT NULL DEFAULT 0,
plat BOOLEAN NOT NULL DEFAULT 0,
dlc BOOLEAN NOT NULL DEFAULT 0,
physical BOOLEAN NOT NULL DEFAULT 0
";
