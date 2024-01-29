<?php
    require '../../includes/auth/check-auth.php';
    if (!$valid_auth) {
        exit();
    }
    require '../../includes/db/db-config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Games</title>
    <?php
        require "../../includes/header.php";
        get_header();
        get_stylesheet("listing.css");
        get_stylesheet("inventory.css");
        get_script("inventory.js");
    ?>
</head>

<body>
    <?php
        require '../../includes/html-builder.php';
        echo get_topbar_html();
    ?>
    <div class="page-container">
        <?php
            echo get_leftbar_html("Games", "");
        ?>
        <div class="content">
            <div class="page-title">
                <span>Manage Games</span>
            </div>
            <div class="action-button-container">
                <div class="action-button action-button-new unified-container">
                    <div class="action-icon"><img src="/resources/png/action-button-new.png"></div>
                    <div class="action-text">New Game</div>
                </div>
                <div class="action-button action-button-import unified-container">
                    <div class="action-icon"><img src="/resources/png/action-button-import.png"></div>
                    <div class="action-text">Import Data</div>
                </div>
            </div>
            <div class="game-list unified-container csv">
                <?php
                    require '../../includes/list-builder.php';
                    echo get_listing_html("csv", true);
                ?>
            </div>
            <?php
                get_page_navigation_html('/inventory/game/');
            ?>
        </div>
    </div>
</body>

</html>
