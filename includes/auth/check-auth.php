<?php

define('SESSION_VALID_AUTH', 'validauth');
define('VALID_AUTH_YES', 'yes');

$valid_auth = false;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION[SESSION_VALID_AUTH])) {
    header("Location: /login/?r=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

if ($_SESSION[SESSION_VALID_AUTH] === VALID_AUTH_YES) {
    $valid_auth = true;
}
