<?php
require_once '../config/constants.php';
require_once '../service/verifyEmail.php';
$emailService = new VerifyEmailService();
$emailService->verifyEmail($_GET['email']);
?>