<?php

include_once '../../../includes/auth/check-auth.php';
if (!$valid_auth) {
    exit();
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <title>New Icon</title>';

require_once '../../../includes/header.php';
get_header();
get_stylesheet("input.css");

echo '
</head>
<body>
<div class="content">
    <div class="page-title">
        <span>New Icon</span>
    </div>
    <div class="input-outer-container">';

require_once "../../../includes/input-builder.php";
get_icon_input_html("add");

echo '
    </div>
</div>
</body>
</html>';

