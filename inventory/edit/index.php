<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Game</title>
    <?php
        require_once '../../includes/header.php';
        get_header();
        get_stylesheet("input.css");
        get_script("input.js");
    ?>
</head>

<body>
    <div class="content">
        <div class="page-title">
            <span>Edit Game</span>
        </div>
        <div class="input-outer-container">
            <?php
                require_once "../../includes/input-builder.php";
                get_input_html("edit");
            ?>
        </div>
    </div>
</body>

</html>