<?php
    include_once '../../includes/auth/check-auth.php';
    if (!$valid_auth) {
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Game</title>
    <?php
        require_once '../../includes/header.php';
        get_header();
        get_stylesheet("input.css");
    ?>
</head>

<body>
    <?php
        require_once '../../includes/html-builder.php';
        echo get_topbar_html();
    ?>
    <div class="page-container">
        <?php
            require_once '../../includes/html-builder.php';
            echo get_leftbar_html("Games", "inventory");
        ?>
        <div class="content">
            <div class="page-title">
                <span>Edit Game</span>
            </div>
            <div class="input-outer-container">
                <?php
                    require_once "../../includes/input-builder.php";
                    get_input_html("edit");
                ?>
            </div>
        </div>
    </div>
</body>

</html>