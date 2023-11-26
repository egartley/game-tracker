<!DOCTYPE html>
<html lang="en">

<head>
    <title>Game Details</title>
    <?php
        require_once '../includes/header.php';
        get_header();
        get_stylesheet("details.css");
    ?>
</head>

<body>
    <?php
        require_once '../includes/html-builder.php';
        echo get_topbar_html();
    ?>
    <div class="page-container">
        <?php
            require_once '../includes/html-builder.php';
            echo get_leftbar_html("Games", "");
        ?>
        <div class="content">
            <?php
                require_once "../includes/details-builder.php";
                get_details_html();
            ?>
        </div>
    </div>
</body>

</html>
