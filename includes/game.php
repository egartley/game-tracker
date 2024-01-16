<?php

class Game
{
    public string $title = '';
    public string $company = '';
    public string $platform = '';
    public int $year = 0;
    public float $rating = 0.0;
    public int $playthroughs = 0;
    public int $hours = 0;
    public bool $hundo = false;
    public bool $plat = false;
    public bool $dlc = false;
    public bool $physical = false;
    public int $iconid = 0;
    public int $id = 0;
    public string $iconfile = '';
    public string $notes = '';
    public string $tags = '';

    function get_rating_html(): string
    {
        $full_stars = intdiv($this->rating, 1);
        $has_half = $this->rating != (float)$full_stars;
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

    function get_tags_html($alltags, $deleteable): string
    {
        if ($this->tags == '') {
            return '';
        }
        $content = '';
        $mytags = array($this->tags);
        if (str_contains($this->tags, ",")) {
            $mytags = explode(",", $this->tags);
        }
        foreach ($alltags as $tag) {
            if (in_array($tag->id, $mytags)) {
                $del = '<span class="tag-delete-x" tagval="' . $tag->text . '" tagid="' . $tag->id . '">X</span>';
                if (!$deleteable) {
                    $del = '';
                }
                $content .= '<span class="game-tag" id="tag-' . $tag->text . '">' . $tag->text . $del . '</span>';
            }
        }
        return $content;
    }
}
