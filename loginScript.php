<?php session_start();
//TODO: https://www.php.net/manual/en/ref.pdo-mysql.php
require 'config.php';

    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //Hashing password with bcrypt

        $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = 'SELECT * FROM user WHERE password=$password and username=$username';
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            }
        } else {
            header('Location: login.php?loginError="Incorrect username or password!"');
        }
        $conn->close();

        header('Location: home.php');
    } else {
        header('Location: login.php?loginError="Incorrect username or password!"');
    }
    exit();