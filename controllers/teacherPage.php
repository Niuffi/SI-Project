<?php
require_once('functions.php');

connectDB();

$Info = printUserDataById($_SESSION['user']['ID']);
?>