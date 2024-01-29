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

    private const FULL_STAR_IMG = '<img src="/resources/png/sf.png">';
    private const HALF_STAR_IMG = '<img src="/resources/png/sh.png">';
    private const EMPTY_STAR_IMG = '<img src="/resources/png/se.png">';

    public function get_rating_html(): string
    {
        $full_stars = intdiv($this->rating, 1);
        $has_half = $this->rating != (float)$full_stars;
        $empties = 5 - ceil($this->rating);

        $content = str_repeat(self::FULL_STAR_IMG, $full_stars);
        if ($has_half) {
            $content .= self::HALF_STAR_IMG;
        }
        if ($empties > 0) {
            $content .= str_repeat(self::EMPTY_STAR_IMG, $empties);
        }

        return $content;
    }

    public function get_tags_html(array $alltags, bool $deleteable): string
    {
        if ($this->tags == '') {
            return '';
        }
        $content = '';
        $mytags = str_contains($this->tags, ",") ? explode(",", $this->tags) : [$this->tags];
        foreach ($alltags as $tag) {
            if (in_array($tag->id, $mytags)) {
                $del = $deleteable ? sprintf('<span class="tag-delete-x" tagval="%s" tagid="%s">X</span>', $tag->text, $tag->id) : '';
                $content .= sprintf('<span class="game-tag" id="tag-%s">%s%s</span>', $tag->text, $tag->text, $del);
            }
        }
        return $content;
    }
}
