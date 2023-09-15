<!DOCTYPE html>
<head>
    <?php
        require_once 'includes/core/min-header.php';
        require_once 'includes/html-builder/toolbar.php';
        get_stylesheet("toolbar.css");
    ?>
    <title>Dashboard</title>
</head>
<body>
<?php
    echo get_generic_toolbar_html("Dashboard");
?>
<div class="outter">
    <div class="block-container">
        <div class="base-dialog-modal">
            <div class="dialog-title">
                <span>All Pages</span>
            </div>
            <div class="dialog-content">
                <div><p>Pages list html blah blah blah</p></div>
                <button id="makenewpage">Make New</button>
            </div>
        </div>
    </div>
</div>
</body>