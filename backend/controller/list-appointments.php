<?php
require_once '../config/constants.php';
require_once '../service/appointment.php';
session_start();
if((isset($_SESSION['user'])) && (!empty($_SESSION['user']))){
    $user = $_SESSION['userid'];
    $Appointment = new AppointmentService($user);
    $Appointment->listAll();
}
else {
    echo "interzis";
    return http_response_code(406);
}
?>