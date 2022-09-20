<?php
require_once '../config/constants.php';
require_once '../service/dangling-pointers-serv.php';

$date = json_decode(file_get_contents('php://input'), true);
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))&& ($_SESSION['acces']==3)){
    empty($date['rand_id']) ? die(http_response_code(406)):$rand_id = $date['rand_id'];
    empty($date['referinta']) ? die(http_response_code(406)):$referinta = $date['referinta'];
    empty($date['tabela']) ? die(http_response_code(406)):$tabela = $date['tabela'];
    empty($date['coloana']) ? die(http_response_code(406)):$coloana = $date['coloana'];
    empty($date['coloana_nume']) ? die(http_response_code(406)):$coloana_nume = $date['coloana_nume'];
    $cheiStraine = new DanglingPointers();
    $cheiStraine->actualizareDanglingPointers($rand_id, $referinta, $tabela, $coloana, $coloana_nume);
}
else {
    echo "interzis";
    return http_response_code(406);
}
?>