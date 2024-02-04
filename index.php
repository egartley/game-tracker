<?php
    require 'includes/db/db-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Game Tracker</title>
    <?php
        require 'includes/header.php';
        get_header();
        get_stylesheet("listing.css");
        get_script("listing.js");
    ?>
</head>

<body>
    <?php
        require 'includes/html-builder.php';
        echo get_topbar_html();
    ?>
    <div class="page-container">
        <?php
            echo get_leftbar_html("Games", "");
        ?>
        <div class="content">
            <div class="page-title">
                <span>All Games</span>
            </div>
            <div class="game-list unified-container compact">
                <?php
                    require 'includes/list-builder.php';
                    echo get_listing_html("compact");
                ?>
            </div>
            <?php
                get_page_navigation_html('/');
            ?>
        </div>
    </div>
</body>

</html>
