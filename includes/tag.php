<?php

class Tag
{
    public int $id = 0;
    public string $text = '';

    function __construct(int $id, string $text)
    {
        $this->id = $id;
        $this->text = $text;
    }
}
