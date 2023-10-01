<?php

include_once '../../includes/auth/check-auth.php';
if (!$valid_auth) {
    exit();
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Icons</title>';

require_once '../../includes/header.php';
get_header();
get_stylesheet("listing.css");
get_stylesheet("inventory.css");
get_script("inventory.js");

echo '
</head>
<body>
<div class="content">
    <div class="page-title">
        <span>Manage Icons</span>
    </div>
    <div class="action-button-container">
        <div class="action-button action-button-new-icon unified-container">
            <div class="action-icon"><img src="/resources/png/action-button-new.png"></div>
            <div class="action-text">New Icon</div>
        </div>
    </div>
    <div class="game-list unified-container csv">';

require_once '../../includes/list-builder.php';
get_icon_listing_html();

echo '
    </div>
</div>
</body>
</html>';
