<?php

class Icon
{
    public int $id = 0;
    public string $filename = '';

    function __construct($id, $filename)
    {
        $this->id = $id;
        $this->filename = $filename;
    }
}
