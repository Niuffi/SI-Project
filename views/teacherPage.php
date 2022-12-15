<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>teacher Page</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        include_once("navbar.php");
        ?>
        <?php
        if(isset($Info)) echo $Info;
        ?>
    </body>
</html>