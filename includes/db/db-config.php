<?php

$games_table_name = "games";
$icons_table_name = "icons";
$tags_table_name = "tags";
$editor_table_name = "editor";

$games_table_schema = "
id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
physical BOOLEAN NOT NULL DEFAULT 0,
iconid INT(6) NOT NULL DEFAULT 0
";
$icons_table_schema = "
id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
filename VARCHAR(100) NOT NULL DEFAULT ''
";
$tags_table_schema = "
id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
text VARCHAR(128) NOT NULL DEFAULT ''
";
$editor_table_schema = "
passhash VARCHAR(255) NOT NULL PRIMARY KEY
";

$icons_table_columns = "(filename)";
$tags_table_columns = "(text)";
$games_table_columns = "(title, year, platform, company, rating, hours, playthroughs, hundo, plat, dlc, physical, iconid)";
$editor_table_columns = "(passhash)";
