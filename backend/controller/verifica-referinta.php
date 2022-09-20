<?php
require_once '../config/constants.php';
require_once '../service/verif-referintaServ.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))&& ($_SESSION['acces']==3)){
    $oraStart = 8;
    $oraStop = 17;
    empty($_GET['cv']) ? die(http_response_code(406)):$cv = $_GET['cv'];
    empty($_GET['tv']) ? die(http_response_code(406)):$tv = $_GET['tv'];
    empty($_GET['crv']) ? die(http_response_code(406)):$crv = $_GET['crv'];
    empty($_GET['trv']) ? die(http_response_code(406)):$trv = $_GET['trv'];

    $referinte = new VerificaReferinta($cv,$tv,$crv,$trv);
    $referinte->list();
}
else {
    echo "interzis";
    return http_response_code(406);
}
?>