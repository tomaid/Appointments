<?php
session_start();
if((isset($_SESSION['acces'])) && (!empty($_SESSION['acces']))){
    $value[] = array("acces" => $_SESSION['acces']);
    $json = json_encode($_SESSION['acces']);
    echo $json;
    return http_response_code(200);
}else {
    echo "interzis";
    return http_response_code(406);
}
?>