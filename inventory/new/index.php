<!DOCTYPE html>
<html lang="em">

<head>
    <title>New Game</title>
    <?php
        require_once '../../includes/header.php';
        get_header();
        get_stylesheet("new-game.css");
        get_script("new-game.js");
    ?>
</head>

<body>
    <div class="content">
        <div class="page-title">
            <span>New Game</span>
        </div>
        <div class="new-game-container">
            <div class="input-container">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" maxlength="200">
            </div>
            <div class="input-container">
                <label for="year">Year:</label>
                <input type="text" id="year" name="year" maxlength="4">
            </div>
            <div class="input-container">
                <label for="platform">Platform:</label>
                <input type="text" id="platform" name="platform" maxlength="50">
            </div>
            <div class="input-container">
                <label for="company">Company:</label>
                <input type="text" id="company" name="company" maxlength="100">
            </div>
            <div class="input-container">
                <label for="rating">Rating:</label>
                <input type="range" id="rating" name="rating" value="3.5" min="0" max="5" step="0.5"
                    oninput="$('span#ratingvalue').html($(this).val())">
                <span id="ratingvalue">3.5</span>
            </div>
            <div class="input-container">
                <label for="hours">Hours:</label>
                <input type="text" id="hours" name="hours" maxlength="3">
            </div>
            <div class="input-container">
                <label for="playthroughs">Playthroughs:</label>
                <input type="text" id="playthroughs" name="playthroughs" maxlength="3">
            </div>
            <div class="input-container">
                <label for="hundo">100% Completion:</label>
                <input type="checkbox" id="hundo" name="hundo">
            </div>
            <div class="input-container">
                <label for="plat">Platinum Trophy:</label>
                <input type="checkbox" id="plat" name="plat">
            </div>
            <div class="input-container">
                <label for="dlc">DLC:</label>
                <input type="checkbox" id="dlc" name="dlc">
            </div>
            <div class="input-container">
                <label for="physical">Physical Copy:</label>
                <input type="checkbox" id="physical" name="physical">
            </div>
            <div class="input-container">
                <button class="submit">Submit</button>
            </div>
        </div>
    </div>
</body>

</html>