<?php

if (isset($_FILES['iconfile'])) {
    // Adopted from https://www.w3schools.com/php/php_file_upload.asp
    $uploaded_file = $_FILES['iconfile'];
    $target_path = $_SERVER['DOCUMENT_ROOT'] . '/resources/png/icon/' . basename($uploaded_file['name']);
    $file_type = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
    $issues = file_exists($target_path) || $uploaded_file['size'] > 2000000 ||
        ($file_type != 'jpg' && $file_type != 'png' && $file_type != 'jpeg');

    if (!$issues) {
        if (move_uploaded_file($uploaded_file['tmp_name'], $target_path)) {
            require_once '../../../includes/db/db-connection.php';
            require_once '../../../includes/db/icons-table.php';
            $connection = get_mysql_connection();
            verify_icons_table($connection);
            add_icon($connection, $uploaded_file['name']);
            $connection->close();
            header('Location: /inventory/icon/');
        }
    } else {
        echo '<p>There was an issue</p>';
    }
} else if (isset($_FILES['iconfiles'])) {
    // Adopted from https://stackoverflow.com/a/12006515
    $iconfiles = $_FILES['iconfiles'];
    $files = array_filter($iconfiles['name']);
    $count = count($iconfiles['name']);

    require_once '../../../includes/db/db-connection.php';
    require_once '../../../includes/db/icons-table.php';
    $connection = get_mysql_connection();
    verify_icons_table($connection);

    for ($i = 0; $i < $count; $i++) {
        $tmp_path = $iconfiles['tmp_name'][$i];
        $target_path = $_SERVER['DOCUMENT_ROOT'] . '/resources/png/icon/' . basename($iconfiles['name'][$i]);
        $file_type = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
        $issues = file_exists($target_path) || $iconfiles['size'][$i] > 2000000 ||
            ($file_type != 'jpg' && $file_type != 'png' && $file_type != 'jpeg');

        if (!$issues && $tmp_path != '') {
            if (move_uploaded_file($tmp_path, $target_path)) {
                add_icon($connection, $iconfiles['name'][$i]);
            }
        } else {
            echo '<p>There was an issue with ' . $iconfiles['name'][$i] .'</p>';
        }
    }

    $connection->close();
    header('Location: /inventory/icon/');
}
