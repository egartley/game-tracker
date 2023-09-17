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
    public $hours = 0;
    public $hundo = false;
    public $plat = false;
    public $dlc = false;
    public $physical = false;

    function __construct($title, $year, $platform, $company, $rating)
    {
        $this->title = $title;
        $this->year = $year;
        $this->platform = $platform;
        $this->company = $company;
        $this->rating = $rating;
    }

    function get_rating_html()
    {
        $full_stars = intdiv($this->rating, 1);
        $has_half = $this->rating !== $full_stars;
        $empties = 5 - ceil($this->rating);

        $content = str_repeat('<img src="/resources/png/sf.png">', $full_stars);
        if ($has_half) {
            $content .= '<img src="/resources/png/sh.png">';
        }
        if ($empties > 0) {
            $content .= str_repeat('<img src="/resources/png/se.png">', $empties);
        }

        return $content;
    }
}
