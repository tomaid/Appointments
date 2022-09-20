<?php
require_once '../config/constants.php';
require_once '../service/authentication.php';
session_start();
    if((isset($_SESSION['user']))&&($_SESSION['user']!=="")) {
     $authenticated = new Authentication($_SESSION['user']);
     $authenticated->verifyAuth();
    }
    else{
         return http_response_code(406);
    }
?>
