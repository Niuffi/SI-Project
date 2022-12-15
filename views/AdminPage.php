<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Page</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <?php
        if(isset($Info)) echo $Info;
        ?>
        <?php
        if(isset($Infoo)) echo $Infoo;
        ?>
    </body>
</html>