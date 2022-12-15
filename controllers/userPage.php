<?php
    require_once('functions.php');

    $db = connectDB();
    $Info = printData('user', 1);
    disconnectDB($db);
?>