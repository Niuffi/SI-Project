<?php
define('_ROOT_PATH', dirname(__FILE__));
define('_CONTROLLERS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR);
define('_VIEWS_PATH', _ROOT_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

session_start();

$db;
$error_connecting = false;
$error_message = '';


function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=projekt_si;port=3306', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $e) {
    $error_connecting = true;
    $error_message = $e->getMessage();
}

if (count($_POST) > 0) {
    if (isset($_POST['gotopage']) && $_POST['gotopage'] == 'Wyloguj') {
        session_destroy();
        header("Refresh:0");
    }
    if (isset($_POST['gotopage'])) {
        switch ($_POST['gotopage']) {
            case 'Zaloguj':
                $_SESSION['page'] = 'login';
                break;
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
                $_SESSION['page'] = 'login';
                break;
        }
        unset($_POST['gotopage']);
    }
}

if (!isset($_SESSION['page'])) {
    session_unset();
    $_SESSION['page'] = 'login';
}
console_log($_SESSION['page']);


include(_CONTROLLERS_PATH . $_SESSION['page'] . '.php');
include(_VIEWS_PATH . $_SESSION['page'] . '.php');

?>