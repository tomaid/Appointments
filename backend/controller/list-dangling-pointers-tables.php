<?php
require_once '../config/constants.php';
require_once '../service/list-dangling-pointers-tables-service.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))&& ($_SESSION['acces']==3)){

    $danglingPointers = new DanglingPointersTables();
    $danglingPointers->listDanglingPointersTables();

}
else {
    echo "interzis";
    return http_response_code(406);
}
?>