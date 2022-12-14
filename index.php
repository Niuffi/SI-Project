<?php
define('_ROOT_PATH', dirname(__FILE__));
define('_CONTROLLERS_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR);
define('_VIEWS_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);

session_start();

$db;
$error_connecting = false;
$error_message = '';

try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=projekt_si;port=3306', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $e) {
    $error_connecting = true;
    $error_message = $e->getMessage();
}

if ($error_connecting) {
    $_SESSION['page'] = 'db_error';
}

if (count($_POST) > 0) {
    if (isset($_POST['gotopage']) && $_POST['gotopage'] == 'Wyloguj') {
        session_destroy();
        header("Refresh:0");
    }

    if (isset($_POST['gotopage'])) {
        switch ($_POST['gotopage']) {
            case 'Uzytkownicy':
                $_SESSION['page'] = 'users';
                break;
            case 'Ksiazki':
                if ($_SESSION['user']['Privileges'] == 'admin') {
                    $_SESSION['page'] = 'books_admin';
                } else {
                    $_SESSION['page'] = 'books_user';
                }
                break;
            case 'Dodaj uzytkownika':
                $_SESSION['page'] = 'add_user';
                break;
            case 'Dodaj ksiazke':
                $_SESSION['page'] = 'add_book';
                break;
            case 'Ksiazki pozyczone':
                $_SESSION['page'] = 'checked_out';
                break;
            default:
                $_SESSION['page'] = 'login';
                break;
        }
        unset($_POST['gotopage']);
    }
}

$page = '';
if (!isset($_SESSION['page'])) {
    session_unset();
    $_SESSION['page'] = 'login';
}

include(_CONTROLLERS_PATH.$_SESSION['page'].'.php');
include(_VIEWS_PATH.$_SESSION['page'].'.php');

?>