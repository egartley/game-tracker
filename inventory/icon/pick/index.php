<?php
    include_once '../../../includes/auth/check-auth.php';
    if (!$valid_auth) {
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pick Icon</title>
    <?php
        require_once '../../../includes/header.php';
        get_header();
        get_stylesheet("listing.css");
        get_stylesheet("inventory.css");
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
                <span>Pick Icon</span>
            </div>
            <div class="game-list unified-container icon-grid">
                <?php
                    require_once '../../../includes/list-builder.php';
                    $id = 0;
                    if (isset($_GET['game'])) {
                        $id = $_GET['game'];
                    }
                    get_icon_listing_html('grid', $id);
                ?>
            </div>
        </div>
    </div>
</body>

</html>