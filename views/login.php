<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            if (isset($_GET['loginError'])) {
                echo $_GET['loginError'];
            }
         ?>
        <form action="loginScript.php" method="post">dsdsdsdsdsdsdsdsdsdsdsds
            Login:<input name="username" type="text">
            Password:<input name="password" type="password">
            <input type="submit" value="Log In">
        </form>
    </body>
</html>