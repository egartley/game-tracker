<?php

function get_subsidelink_html($name, $is_active, $path)
{
    $html = '<a class="link-ignore sub-side-link-href" href="' . $path . '"><div class="sub-side-link flex center-items';
    if ($is_active) {
        $html .= ' sub-side-link-active';
    }
    $html .= '"><span>' . $name . '</span></div></a>';
    return $html;
}

function get_sidelink_html($name, $is_active)
{
    $html = '<a class="link-ignore side-link-href" href="/"><div class="side-link flex center-items';
    if ($is_active) {
        $html .= ' side-link-active';
    }
    $html .= '"><img src="/resources/png/side-link-' . strtolower($name);
    if ($is_active) {
        $html .= '-active';
    }
    $html .= '.png"><span>' . $name . '</span></div></a>';
    return $html;
}

function get_leftbar_html($active_sidelink, $active_subsidelink)
{
    $html = '<div class="leftbar"><div class="side-link-container flex col">';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $loggedin = isset($_SESSION['validauth']) && $_SESSION['validauth'] === 'yes';
    $sidelinks = array('Games');
    $subsidelinks_games = array(array('Inventory', '/inventory/game'), array('Icons', '/inventory/icon'), array('Tags', '/inventory/tag'));
    foreach ($sidelinks as $sidelink) {
        $html .= get_sidelink_html($sidelink, strtolower($sidelink) === strtolower($active_sidelink));
        if ($loggedin && $sidelink === 'Games') {
            foreach ($subsidelinks_games as $sub) {
                $html .= get_subsidelink_html($sub[0], strtolower($sub[0]) === strtolower($active_subsidelink), $sub[1]);
            }
        }
    }
    $html .= '</div></div>';
    return $html;
}

function get_topbar_html()
{
    $html = '<div class="topbar unified-container"><span id="topbar-title">Game Tracker</span>';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $loggedin = isset($_SESSION['validauth']) && $_SESSION['validauth'] === 'yes';

    $html .= '<span class="flex center-items" id="editor-login"><img src="/resources/png/';
    if ($loggedin) {
        $html .= 'unlock';
    } else {
        $html .= 'lock';
    }
    $html .= '.png"><span><a href="/';
    if ($loggedin) {
        $html .= 'logout';
    } else {
        $html .= 'login';
    }
    $html .= '">Log ';
    if ($loggedin) {
        $html .= 'out';
    } else {
        $html .= 'in';
    }
    $html .= '</a></span></span></div>';

    return $html;
}
