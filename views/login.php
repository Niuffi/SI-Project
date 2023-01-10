<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <section class="login-section">
        <h1>DZIENNIK ELEKTRONICZNY</h1>
        <form action="index.php" method="post" class="login-form">
        <h1>Zaloguj się</h1>    
        <label>Login: </label>
            <input name="username" placeholder="Login" type="text" class="login-input">
            <label>Hasło: </label>
            <input name="password" placeholder="Hasło" type="password" class="login-input">
            <select name="loginOption" class="login-selection">
                <option value="teacher">Nauczyciel</option>
                <option value="user">Uczeń/Rodzic</option>
                <option value="admin">Admin</option>
            </select>
            <?php
        if ($errors)
            echo "<h3 class='login-error-message'>Nieprawidłowe dane!</h3>";
        ?>
            <input type="submit" name="gotopage" value="Zaloguj" class="login-button">
        </form>
        
    </section>
</body>

</html>