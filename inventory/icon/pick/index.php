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
    <title>Pick Icon</title>
    <?php
        require '../../../includes/header.php';
        get_header();
        get_stylesheet("listing.css");
        get_stylesheet("inventory.css");
        get_script("listing.js");
    ?>
</head>

<body>
    <?php
        require '../../../includes/html-builder.php';
        echo get_topbar_html();
    ?>
    <div class="page-container">
        <?php
            echo get_leftbar_html("Games", "icons");
        ?>
        <div class="content">
            <div class="page-title">
                <span>Pick Icon</span>
            </div>
            <div class="game-list unified-container icon-grid">
                <?php
                    require '../../../includes/list-builder.php';
                    $id = 0;
                    if (isset($_GET['game'])) {
                        $id = $_GET['game'];
                    }
                    echo get_icon_listing_html('grid', $id);
                ?>
            </div>
            <?php
                get_page_navigation_html_icon('/inventory/icon/pick/');
            ?>
        </div>
    </div>
</body>

</html>