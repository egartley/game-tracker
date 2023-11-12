<?php

$valid_auth = false;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["validauth"])) {
    header("Location: /login/?r=" . urlencode($_SERVER['REQUEST_URI']));
} else if ($_SESSION["validauth"] === "yes") {
    $valid_auth = true;
}
