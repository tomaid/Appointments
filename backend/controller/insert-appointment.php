<?php
require_once '../config/constants.php';
require_once '../service/appointment.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))){
    $date = json_decode(file_get_contents('php://input'), true);
    $user = $_SESSION['userid'];
    $oraStart = 8;
    $oraStop = 17;
    empty($date['medicid']) ? die(http_response_code(406)):$medicId = $date['medicid'];
    empty($date['data']) ? die(http_response_code(406)) : $data = $date['data'];
    empty($date['ora']) ? die(http_response_code(406)) : $ora = $date['ora'];
    $nsertAppointment = new AppointmentService($user, $medicId,  $data, $ora, $oraStart, $oraStop);
    $nsertAppointment->insert();
}
else {
    echo "interzis";
    return http_response_code(406);
}
?>