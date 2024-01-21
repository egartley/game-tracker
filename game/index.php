<?php
    require '../includes/db/db-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Game Details</title>
    <?php
        require '../includes/header.php';
        get_header();
        get_stylesheet("details.css");
    ?>
</head>

<body>
    <?php
        require '../includes/html-builder.php';
        echo get_topbar_html();
    ?>
    <div class="page-container">
        <?php
            echo get_leftbar_html("Games", "");
        ?>
        <div class="content">
            <?php
                require "../includes/details-builder.php";
                get_details_html();
            ?>
        </div>
    </div>
</body>

</html>
