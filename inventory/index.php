<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Inventory</title>
    <?php
        require_once '../includes/header.php';
        get_header();
        get_stylesheet("listing.css");
        get_stylesheet("inventory.css");
        get_script("inventory.js");
    ?>
</head>

<body>
    <div class="content">
        <div class="page-title">
            <span>Manage Inventory</span>
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
                require_once '../includes/list-builder.php';
                get_listing_html("csv", true);
            ?>
        </div>
    </div>
</body>

</html>