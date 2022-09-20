<?php
require_once '../config/constants.php';
require_once '../service/chei-straineServ.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))&& ($_SESSION['acces']==3)){

    $cheiStraine = new CheiStraineService();
    $cheiStraine->listCheiStraine();

}
else {
    echo "interzis";
    return http_response_code(406);
}
?>