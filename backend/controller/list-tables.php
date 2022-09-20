<?php
require_once '../config/constants.php';
require_once '../service/chei-straineServ.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user'])) && ($_SESSION['acces']==3)){
    empty($_GET['bd']) ? die(http_response_code(406)): $bd = $_GET['bd'];
    $cheiStraine = new CheiStraineService();
    $cheiStraine->listTables($bd);
}
else {
    echo "interzis";
    return http_response_code(406);
}
?>