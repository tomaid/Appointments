<?php
require_once '../config/constants.php';
require_once '../service/appointment.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))){
    $user = $_SESSION['userid'];
    empty($_GET['appointid']) ? die(http_response_code(406)):$appointid = $_GET['appointid'];
    empty($_GET['status']) ? die(http_response_code(406)) : $status = $_GET['status'];
    $Appointment = new AppointmentService($user, '',  '', 0, '', '', $appointid, $status);
    $Appointment->changeStatus();
}
else {
    echo "interzis";
    return http_response_code(406);
}
?>