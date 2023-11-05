<?php

include_once '../../includes/auth/check-auth.php';
if (!$valid_auth) {
    exit();
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Import Data</title>';

require_once '../../includes/header.php';
get_header();
get_stylesheet("input.css");
get_script("import.js");

echo '
</head>
<body>
<div class="content">
    <div class="page-title">
        <span>Import Data</span>
    </div>
    <div class="input-outer-container">
        <textarea id="csvtext"></textarea>
        <button class="submit">Submit</button>
    </div>
</div>
</body>
</html>';