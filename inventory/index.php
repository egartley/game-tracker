<!DOCTYPE html>
<html lang="em">

<head>
    <title>Manage Inventory</title>
    <?php
        require_once '../includes/header.php';
        get_header();
        get_stylesheet("listing.css");
        get_stylesheet("inventory.css");
    ?>
</head>

<body>
    <div class="content">
        <div class="page-title">
            <span>Manage Inventory</span>
        </div>
        <div class="action-button-container">
            <div class="action-button unified-container">
                <div class="action-icon"><img src="/resources/png/action-button-new.png"></div>
                <div class="action-text">Add Game</div>
            </div>
            <div class="action-button unified-container">
                <div class="action-icon"><img src="/resources/png/action-button-import.png"></div>
                <div class="action-text">Import Data</div>
            </div>
        </div>
        <div class="game-list unified-container csv">
            <div class="game-listing csv">
                <div class="game-icon"><img src="/resources/png/default-icon.png"></div>
                <div class="game-details">
                    <div class="game-title">Game Title</div>
                    <div class="rating"><img src="/resources/png/sf.png"><img src="/resources/png/sf.png"><img src="/resources/png/sf.png"><img src="/resources/png/sh.png"><img src="/resources/png/se.png"></div>
                    <div class="subtext">2014, PlayStation 4</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
