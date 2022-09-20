<?php
require_once '../config/constants.php';
require_once '../service/appointment.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))){
    $oraStart = 8;
    $oraStop = 17;
    empty($_GET['medicid']) ? die(http_response_code(406)):$medicId = $_GET['medicid'];
    empty($_GET['data']) ? die(http_response_code(406)) : $data = $_GET['data'];
    $Appointment = new AppointmentService($_SESSION['userid'], $medicId,  $data, 0, $oraStart, $oraStop);
    $Appointment->check();
}
else {
    echo "interzis";
    return http_response_code(406);
}
?>