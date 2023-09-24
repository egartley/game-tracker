<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Icon</title>
    <?php
    require_once '../../../includes/header.php';
    get_header();
    get_stylesheet("input.css");
    ?>
</head>

<body>
<div class="content">
    <div class="page-title">
        <span>New Icon</span>
    </div>
    <div class="input-outer-container">
        <?php
        require_once "../../../includes/input-builder.php";
        get_icon_input_html("add");
        ?>
    </div>
</div>
</body>

</html>