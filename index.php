<!DOCTYPE html>
<html lang="en">

<head>
    <title>Game Tracker</title>
    <?php
        require_once 'includes/header.php';
        get_header();
        get_stylesheet("listing.css");
    ?>
</head>

<body>
    <div class="content">
        <div class="page-title">
            <span>Game Tracker</span>
        </div>
        <div class="game-list unified-container compact">
            <?php
                require_once 'includes/list-builder.php';
                get_temp_listing_html("compact");
            ?>
        </div>
    </div>
</body>

</html>
