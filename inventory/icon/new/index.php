<?php
    include_once '../../../includes/auth/check-auth.php';
    if (!$valid_auth) {
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Icon</title>
    <?php
        require_once '../../../includes/header.php';
        get_header();
        get_stylesheet("input.css");
    ?>
</head>

<body>
    <?php
        require_once '../../../includes/html-builder.php';
        echo get_topbar_html();
    ?>
    <div class="page-container">
        <?php
            require_once '../../../includes/html-builder.php';
            echo get_leftbar_html("Games", "icons");
        ?>
        <div class="content">
            <div class="page-title">
                <span>New Icon</span>
            </div>
            <div class="input-outer-container">
                <?php
                require_once "../../../includes/input-builder.php";
                get_icon_input_html("add");
            ?>
            </div>
        </div>
    </div>
</body>

</html>