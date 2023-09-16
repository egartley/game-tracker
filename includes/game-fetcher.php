<?php

require_once 'game.php';

function get_temp_games()
{
    $temp_game = new Game("Game Title", 2014, "PlayStation 4", 3.5, 200);

    return array($temp_game, $temp_game, $temp_game, $temp_game, $temp_game, $temp_game, $temp_game, $temp_game, $temp_game);
}