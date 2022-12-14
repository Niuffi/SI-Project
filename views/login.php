<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <link rel="stylesheet" href="style.css">
        
    </head>
    <body>
    <?php
    include("navbar.php");
    ?>
        <form action="index.php" method="post">
            Login:<input name="username" type="text">
            Password:<input name="password" type="password">
            <input type="submit" name="gotopage" value="Zaloguj">
        </form>
        <?php
        if ($errors)
            echo "Nieprawidłowe dane!";
        ?>
    </body>
</html>