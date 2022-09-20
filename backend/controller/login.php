<?php
require_once '../config/constants.php';
require_once '../service/login.php';
$date = json_decode(file_get_contents('php://input'), true);
empty($date['user']) ? die(http_response_code(406)):$user = $date['user'];
empty($date['pass']) ? die(http_response_code(406)) : $password = $date['pass'];
$accountLogin = new Login($user,$password);
$accountLogin->loginCont();
?>