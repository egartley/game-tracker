<?php
    include_once '../../../includes/auth/check-auth.php';
    if (!$valid_auth) {
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Game</title>
    <?php
        require_once '../../../includes/header.php';
        get_header();
        get_stylesheet("input.css");
        get_script("input.js");
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
            echo get_leftbar_html("Games", "inventory");
        ?>
        <div class="content">
            <div class="page-title">
                <span>New Game</span>
            </div>
            <div class="input-outer-container">
                <?php
                    require_once "../../../includes/input-builder.php";
                    get_input_html("new");
                ?>
            </div>
        </div>
    </div>
</body>

</html>