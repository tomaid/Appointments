<?php
require_once '../config/constants.php';
require_once '../service/doctors.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))){
    $doctors = new Doctors();
    $doctors->listDoctors();
}
else {
    echo "interzis";
    return http_response_code(406);
}
?>