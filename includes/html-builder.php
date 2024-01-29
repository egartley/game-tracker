<?php

function get_subsidelink_html(string $name, bool $is_active, string $path): string
{
    $activeClass = $is_active ? ' sub-side-link-active' : '';
    $html = sprintf(
        '<a class="link-ignore sub-side-link-href" href="%s"><div class="sub-side-link flex center-items%s"><span>%s</span></div></a>',
        $path,
        $activeClass,
        $name
    );
    return $html;
}

function get_sidelink_html(string $name, bool $is_active, bool $loggedin): string
{
    $href = $loggedin ? '/inventory/game' : '/';
    $activeClass = $is_active ? ' side-link-active' : '';
    $activeSuffix = $is_active ? '-active' : '';

    $html = sprintf(
        '<a class="link-ignore side-link-href" href="%s">
        <div class="side-link flex center-items%s">
        <img src="/resources/png/side-link-%s%s.png"><span>%s</span>
        </div></a>',
        $href,
        $activeClass,
        strtolower($name),
        $activeSuffix,
        $name
    );

    return $html;
}

function get_leftbar_html(string $active_sidelink, string $active_subsidelink): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $isLoggedIn = isset($_SESSION['validauth']) && $_SESSION['validauth'] === 'yes';
    $sidelinks = ['Games'];
    $subsidelinks_games = [['Icons', '/inventory/icon'], ['Tags', '/inventory/tag']];

    $html = '<div class="leftbar"><div class="side-link-container flex col">';
    foreach ($sidelinks as $sidelink) {
        $isActiveSidelink = strtolower($sidelink) === strtolower($active_sidelink);
        $html .= get_sidelink_html($sidelink, $isActiveSidelink, $isLoggedIn);
        if ($isLoggedIn && $sidelink === 'Games') {
            foreach ($subsidelinks_games as $sub) {
                $isActiveSubsidelink = strtolower($sub[0]) === strtolower($active_subsidelink);
                $html .= get_subsidelink_html($sub[0], $isActiveSubsidelink, $sub[1]);
            }
        }
    }
    $html .= '</div></div>';

    return $html;
}

function get_topbar_html(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $isLoggedIn = isset($_SESSION['validauth']) && $_SESSION['validauth'] === 'yes';
    $lockStatus = $isLoggedIn ? 'unlock' : 'lock';
    $loginStatus = $isLoggedIn ? 'logout' : 'login';
    $logText = $isLoggedIn ? 'out' : 'in';

    $html = sprintf(
        '<div class="topbar unified-container"><a id="topbar-title" href="/">Game Tracker</a>
        <span class="flex center-items" id="editor-login">
        <img src="/resources/png/%s.png">
        <span><a href="/%s">Log %s</a></span></span></div>',
        $lockStatus,
        $loginStatus,
        $logText
    );

    return $html;
}
