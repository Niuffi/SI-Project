<?php session_start();
require_once('functions.php');

//Show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('_ROOT_PATH', dirname(__FILE__));
define('_CONTROLLERS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR);
define('_VIEWS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

    if (isset($_SESSION['user']) && isset($_SESSION['AccountType']) && $_POST['gotopage']) {
        switch ($_POST['gotopage']) {
            case 'userPage':
                $_SESSION['page'] = 'userPage';
                break;

            case 'adminPage':
                $_SESSION['page'] = 'adminPage';
                break;

            case 'teacherPage':
                $_SESSION['page'] = 'teacherPage';
                break;

            default:
                session_unset();
                session_destroy();
                header('Location: login.php?loginError="Incorrect username or password!"');
        }
        unset($_POST['gotopage']);
    } else {
        session_unset();
        session_destroy();
        header('Location: login.php?loginError');
    }

    console_log($_SESSION['page']);

include(_CONTROLLERS_PATH . $_SESSION['page'] . '.php');
include(_VIEWS_PATH . $_SESSION['page'] . '.php');

?>