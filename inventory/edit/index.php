<?php

include_once '../../includes/auth/check-auth.php';
if (!$valid_auth) {
    exit();
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Game</title>';

require_once '../../includes/header.php';
get_header();
get_stylesheet("input.css");
get_script("input.js");

echo '
</head>
<body>
<div class="content">
    <div class="page-title">
        <span>Edit Game</span>
    </div>
    <div class="input-outer-container">';

require_once "../../includes/input-builder.php";
get_input_html("edit");

echo '
    </div>
</div>
</body>
</html>';
