<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
        include("navbar.php");
        ?>
        <?php
        if(isset($Info)) echo trim($Info);
        ?>
        
    </body>
</html>