<?php


$found = false;
$errors = false;
$conn = new PDO("mysql:host=127.0.0.1;dbname=projekt_si;", 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$_SESSION['loggedIn'] = false;

if (count($_POST) > 0) {
    $stmt = $conn->query('SELECT Login, Password, AccountType FROM user');

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['Login'] == $_POST['username'] && $row['AccountType'] == $_POST['loginOption']) {
            $found = true;
            break;
        }
    }
    if ($found) {
        $stmt = $conn->query('SELECT * FROM user WHERE Login="' . $_POST['username'] . '"');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['Password'] != $_POST['password']) {
            $errors = true;
        } else {
            $_SESSION['user'] = $row;
            switch ($_POST['loginOption']) {
                case 'teacher':
                    $_SESSION['page'] = 'teacherPage';
                    break;
                case 'user':
                    $_SESSION['page'] = 'userPage';
                    break;
                case 'admin':
                    $_SESSION['page'] = 'adminPage';
                    break;
                default:
                    $_SESSION['page'] = 'login2';
                    break;
            }
            $_SESSION['loggedIn'] = true;
        }
        header("Refresh:0");
    } else {
        $errors = true;
    }
}
?>