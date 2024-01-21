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
    <title>Manage Tags</title>
    <?php
        require '../../includes/header.php';
        get_header();
        get_stylesheet("listing.css");
        get_stylesheet("inventory.css");
        get_stylesheet("input.css");
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
            echo get_leftbar_html("Games", "tags");
        ?>
        <div class="content">
            <div class="page-title">
                <span>Manage Tags</span>
            </div>
            <div class="input-outer-container" style="margin-bottom:32px">
                <div class="input-container">
                    <form action="/inventory/tag/new/index.php" method="post">
                        Create tag:
                        <input type="text" name="text" id="text" maxlength="128">
                        <input type="submit" value="Add" name="submit">
                    </form>
                </div>
            </div>
            <div class="game-list unified-container csv">
                <?php
                    require '../../includes/list-builder.php';
                    get_tag_listing_html();
                ?>
            </div>
        </div>
    </div>
</body>

</html>