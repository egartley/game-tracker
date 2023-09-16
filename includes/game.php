<?php

class Game
{
    public $title = "";
    public $company = "";
    public $platform = "";
    public $year = 0;
    public $rating = 0.0;
    public $iconid = 0;
    public $playthroughs = 0;
    public $hundo = false;
    public $plat = false;

    function __construct($title, $year, $platform, $rating, $iconid)
    {
        $this->title = $title;
        $this->year = $year;
        $this->platform = $platform;
        $this->rating = $rating;
        $this->iconid = $iconid;
    }

    function get_rating_html()
    {
        $full_stars = intdiv($this->rating, 1);
        $has_half = $this->rating !== $full_stars;
        $empties = 5 - ceil($this->rating);

        $content = str_repeat('<img src="/resources/png/sf.png">', $full_stars);
        if ($has_half) {
            $content = $content . '<img src="/resources/png/sh.png">';
        }
        if ($empties > 0) {
            $content = $content . str_repeat('<img src="/resources/png/se.png">', $empties);
        }
        
        return $content;
    }
}