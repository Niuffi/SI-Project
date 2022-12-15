<?php
    require_once('functions.php');

    $db = connectDB();
    $Info = printData('user');
    $Infoo = printData('grades');
    disconnectDB($db);
?>