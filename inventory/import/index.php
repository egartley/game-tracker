<!DOCTYPE html>
<html lang="en">

<head>
    <title>Import Data</title>
    <?php
    require_once '../../includes/header.php';
    get_header();
    get_stylesheet("input.css");
    get_script("import.js");
    ?>
</head>

<body>
<div class="content">
    <div class="page-title">
        <span>Import Data</span>
    </div>
    <div class="input-outer-container">
        <textarea id="csvtext"></textarea>
        <button class="submit">Submit</button>
    </div>
</div>
</body>

</html>