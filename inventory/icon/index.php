<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Icons</title>
    <?php
    require_once '../../includes/header.php';
    get_header();
    get_stylesheet("listing.css");
    get_stylesheet("inventory.css");
    get_script("inventory.js");
    ?>
</head>

<body>
<div class="content">
    <div class="page-title">
        <span>Manage icons</span>
    </div>
    <div class="action-button-container">
        <div class="action-button action-button-new-icon unified-container">
            <div class="action-icon"><img src="/resources/png/action-button-new-icon.png"></div>
            <div class="action-text">New Icon</div>
        </div>
    </div>
    <div class="game-list unified-container csv">
        <?php
        require_once '../../includes/list-builder.php';
        get_icon_listing_html();
        ?>
    </div>
</div>
</body>

</html>