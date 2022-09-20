<?php
require_once '../config/db.class.php';
require_once '../repository/verifyEmail.php';
require_once 'sanitize.php';
class VerifyEmailService {
    public function verifyEmail($email) {
        $db = new DB();
        $connection = $db->conn();
        $sanitize = new Sanitize();
        $repoCount= new VerifyEmail($connection, $sanitize->string($connection, $email));
        if(((int)$repoCount->getCount()) > 0) return http_response_code(406);
        return http_response_code(200);
    }
}
?>