<?php
require_once '../config/constants.php';
require_once '../service/logout.php';
session_start();
if((isset($_SESSION['user']))&&($_SESSION['user']!=="")) {
    $logout = new Logout();
    $logout->destroySession();
}
?>
