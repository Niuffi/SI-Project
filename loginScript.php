<?php session_start();
require_once('functions.php');
require('config.php');

//Show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $_SESSION['loggedIn'] = false;

    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //Hashing password with bcrypt

        $db = connectDB();

        $sql = "SELECT ID, AccountType FROM user WHERE Password=$password and Login=$username;";
        $result = $db->query($sql);

        if ($result > 0) {
            while ($row = $result->fetchAll()) {
                $_SESSION['loginOption'] = $row['AccountType'];
                $_SESSION['user'] = $row['ID'];
            }

            switch ($_SESSION['loginOption']) {
                case 'teacher':
                    $_SESSION['gotopage'] = 'teacherPage';
                    break;
                case 'user':
                    $_SESSION['gotopage'] = 'userPage';
                    break;
                case 'admin':
                    $_SESSION['gotopage'] = 'adminPage';
                    break;
            }
        } else {
            session_unset();
            session_destroy();
            header('Location: login.php?loginError="Incorrect username or password!"');
        }
        disconnectDB($db);
        header('Location: index.php');
    }
?>

