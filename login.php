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
        <br>
        <form action="loginScript.php" method="post">
            Login:<input name="username" type="text"> <br>
            Password:<input name="password" type="password"> <br>

            <input type="submit" value="Log In">

        </form>
    </body>
</html>