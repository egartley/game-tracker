<?php
    require '../../../includes/auth/check-auth.php';
    if (!$valid_auth) {
        exit();
    }
    require '../../../includes/db/db-config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Import Data</title>
    <?php
        require '../../../includes/header.php';
        get_header();
        get_stylesheet("input.css");
        get_script("import.js");
    ?>
</head>

<body>
    <?php
        require '../../../includes/html-builder.php';
        echo get_topbar_html();
    ?>
    <div class="page-container">
        <?php
            echo get_leftbar_html("Games", "inventory");
        ?>
        <div class="content">
            <div class="page-title">
                <span>Import Data</span>
            </div>
            <div class="input-outer-container">
                <textarea id="csvtext"></textarea>
                <button class="submit">Submit</button>
            </div>
        </div>
    </div>
</body>

</html>