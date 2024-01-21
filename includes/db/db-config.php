<?php

define('GAMES_TABLE_NAME', 'games');
define('ICONS_TABLE_NAME', 'icons');
define('TAGS_TABLE_NAME', 'tags');
define('EDITOR_TABLE_NAME', 'editor');

define('GAMES_TABLE_SCHEMA', "id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
iconid INT(6) NOT NULL DEFAULT 0,
notes VARCHAR(8192) NOT NULL DEFAULT '',
tags VARCHAR(128) NOT NULL DEFAULT ''");
define('ICONS_TABLE_SCHEMA', "id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
filename VARCHAR(100) NOT NULL DEFAULT ''");
define('TAGS_TABLE_SCHEMA', "id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
text VARCHAR(128) NOT NULL DEFAULT ''");
define('EDITOR_TABLE_SCHEMA', "passhash VARCHAR(255) NOT NULL PRIMARY KEY");

define('GAMES_TABLE_COLUMNS', '(title, year, platform, company, rating, hours, playthroughs, hundo, plat, dlc, physical, iconid, notes, tags)');
define('ICONS_TABLE_COLUMNS', '(filename)');
define('TAGS_TABLE_COLUMNS', '(text)');
define('EDITOR_TABLE_COLUMNS', '(passhash)');
