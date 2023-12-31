<?php

function get_script($script)
{
    echo '<script src="/resources/js/' . $script . '"></script>';
}

function get_stylesheet($sheet)
{
    echo '<link href="/resources/css/' . $sheet . '" rel="stylesheet" type="text/css">';
}

function get_header()
{
    echo '<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="language" content="en">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="cleartype" content="on">
<meta name="google" value="notranslate">
<meta name="google" content="nositelinkssearchbox">
<link href="/resources/ico/favicon.ico" rel="icon">
<link href="/resources/ico/favicon.ico" rel="shortcut icon" type="images/x-icon">';

    get_script("jquery.js");
    get_stylesheet('min.css');
}
