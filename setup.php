<?php

if (!isset($_POST["passinput"])) {
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Setup</title>
';

    require_once "includes/header.php";
    get_header();
    get_stylesheet("input.css");

    echo '
</head>
<body>
<div class="content">
    <div class="page-title">
        <span>Setup</span>
    </div>
    <div class="input-outer-container">
        <div class="input-container">
            <form action="setup.php" method="post">
                <label for="passinput">Set editor password:</label>
                <input id="passinput" name="passinput" type="password">
                <button class="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>';
} else {
    require_once 'includes/db/db-connection.php';
    require_once 'includes/db/editor-table.php';

    $connection = get_mysql_connection();
    verify_editor_table($connection);
    if (!get_passhash_already_set($connection)) {
        add_editor($connection, password_hash($_POST["passinput"], PASSWORD_DEFAULT));
        $connection->close();
        header("Location: /");
    } else {
        echo "Editor password has already been set";
        $connection->close();
    }
}
