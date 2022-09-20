<?php
require_once '../config/constants.php';
require_once '../service/list-dangling-pointers-tables-service.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))&& ($_SESSION['acces']==3)){
    empty($_GET['tabela']) ? die(http_response_code(406)):$tabela = $_GET['tabela'];
    empty($_GET['coloana']) ? die(http_response_code(406)):$coloana = $_GET['coloana'];
    $danglingPointers = new DanglingPointersTables();
    $danglingPointers->listDanglingPointers($tabela,$coloana);

}
else {
    echo "interzis";
    return http_response_code(406);
}
?>