<?php

if (!isset($_POST["passinput"])) {
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Editor Login</title>
';

    require_once "../includes/header.php";
    get_header();
    get_stylesheet("input.css");

    echo '
</head>
<body>
<div class="content">
    <div class="page-title">
        <span>Editor Login</span>
    </div>
    <div class="input-outer-container">';
    if (isset($_GET["wrong"])) {
        echo '<div class="input-container"><p>Wrong password, try again!</p></div>';
    }
    echo '
        <div class="input-container">
            <form action="/login/index.php" method="post">
                <label for="passinput">Password:</label>
                <input id="passinput" name="passinput" type="password">';
    if (isset($_GET["r"])) {
        echo '<input type="hidden" name="r" id="r" value="' . urldecode($_GET["r"]) . '">';
    }
    echo '
                <button class="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>';
} else {
    require_once '../includes/db/db-connection.php';
    require_once '../includes/db/editor-table.php';

    if (!isset($_POST["r"])) {
        $_POST["r"] = "/";
    }

    $connection = get_mysql_connection();
    verify_editor_table($connection);
    if (get_passhash_already_set($connection)) {
        $actual = get_passhash($connection);
        $connection->close();
        if (password_verify($_POST["passinput"], $actual)) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["validauth"] = "yes";
            header("Location: " . $_POST["r"]);
        } else {
            header("Location: /login/?r=" . urlencode($_POST["r"]) . "&wrong=1");
        }
    } else {
        echo "Password needs to be set";
        $connection->close();
    }
}
