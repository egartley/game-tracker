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
    <title>Manage Icons</title>
    <?php
        require '../../includes/header.php';
        get_header();
        get_stylesheet("listing.css");
        get_stylesheet("inventory.css");
        get_script("listing.js");
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
            echo get_leftbar_html("Games", "icons");
        ?>
        <div class="content">
            <div class="page-title">
                <span>Manage Icons</span>
            </div>
            <div class="action-button-container">
                <div class="action-button action-button-new-icon unified-container">
                    <div class="action-icon"><img src="/resources/png/action-button-new.png"></div>
                    <div class="action-text">New Icon</div>
                </div>
            </div>
            <div class="game-list unified-container csv">
                <?php
                    require '../../includes/list-builder.php';
                    echo get_icon_listing_html();
                ?>
            </div>
            <?php
                get_page_navigation_html('/inventory/icon/');
            ?>
        </div>
    </div>
</body>

</html>