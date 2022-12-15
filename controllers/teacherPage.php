<?php
    require_once('functions.php');

    $db = connectDB();
    $Info = printUserDataById($_SESSION['user']['ID']);
    disconnectDB($db);
?>