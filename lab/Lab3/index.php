
<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SilverJack</title>
        <style>
            @import url("css/style.css");
        </style>
    </head>
    <body>
        <h1>SilverJack</h1>

        <div id = "board">
        <?php
            include 'inc/functions.php';
            gethand();
        ?>
         <form>
            <input type="submit" value="Play Again"/>
        </form>
        </div>
    </body>
