<?php session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $options = [
            'cost' => 4,
        ];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);




        header('Location: home.php?loginError="Incorrect username or password!"');
    } else {
        header("Location: login.php");
    }
    exit();