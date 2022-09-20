<?php
require_once '../config/constants.php';
require_once '../service/register.php';
$date = json_decode(file_get_contents('php://input'), true);
empty($date['user']) ? die(http_response_code(406)):$user = $date['user'];
empty($date['pass']) ? http_response_code(406) : $password = password_hash($date['pass'], PASSWORD_DEFAULT);
empty($date['nume']) ? die(http_response_code(406)): $nume = $date['nume'];
empty($date['prenume']) ? die(http_response_code(406)): $prenume = $date['prenume'];
(empty($date['tel']) || (!is_numeric($date['tel'])) || (strlen($date['tel'])>14))? die(http_response_code(406)): $tel = $date['tel'];
empty($date['type']) ? die(http_response_code(406)):$tipcont = (int)$date['type'];
$accountRegister = new Register($user,$password, $nume, $prenume, $tel, $tipcont);
$accountRegister->creareCont();
?>