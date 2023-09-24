<!DOCTYPE html>
<html lang="en">

<head>
    <title>Import Data</title>
    <?php
    require_once '../../includes/header.php';
    get_header();
    get_script("import.js");
    ?>
</head>

<body>
<div class="content">
    <div class="page-title">
        <span>Import Data</span>
    </div>
    <div style="margin-top:24px">
        <textarea id="csvtext"
                  style="display:block;min-width:800px;max-width:800px;min-height:400px;max-height:500px"></textarea>
        <button class="submit" style="margin-top:24px">Submit</button>
    </div>
</div>
</body>

</html>