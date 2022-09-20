<?php
require_once '../config/db.class.php';
require_once '../repository/login.php';

require_once 'sanitize.php';
class Login {
    private $connection;
    private $user;
    private $pass;

    public function __construct($user ='', $pass = '')
    {
        $db = new DB();
        $this->connection = $db->conn();
        $sanitize = new Sanitize();
        $this->user = $sanitize->string($this->connection, $user);
        $this->pass = $sanitize->string($this->connection, $pass);
    }
    public function loginCont(){
        $dbLogin = new LoginUser($this->connection, $this->user);
        if($dbLogin->verifica_parola($this->pass)){
            session_start();
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['acces'] = $dbLogin->getTipCont();
            $_SESSION['user'] = $this->user;
            $_SESSION['userid'] = $dbLogin->getUserID();
            $_SESSION['nume'] = $dbLogin->getNume();
            $_SESSION['prenume'] = $dbLogin->getPrenume();
            return http_response_code(200);
        }
        else{
            return http_response_code(406);
        }
    }
}
?>