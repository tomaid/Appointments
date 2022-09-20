<?php
require_once '../config/db.class.php';
require_once '../repository/login.php';
require_once 'sanitize.php';
require_once '../service/logout.php';
class Authentication{
    private $user;
    public function __construct($user ='')
    {
        $db = new DB();
        $this->connection = $db->conn();
        $sanitize = new Sanitize();
        $this->user = $sanitize->string($this->connection, $user);
    }
    public function verifyAuth(){
        $dbLogin = new LoginUser($this->connection, $this->user);
        $userverif = $dbLogin->getUserID();
        if(isset($userverif)) {

            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['acces'] = $dbLogin->getTipCont();
            $_SESSION['user'] = $this->user;
            $_SESSION['nume'] = $dbLogin->getNume();
            $_SESSION['prenume'] = $dbLogin->getPrenume();
            $value = array(
                "nume"=>$_SESSION['nume'],
                "prenume"=>$_SESSION['prenume'],
                "user"=>$_SESSION['user'],
                "acces"=>$_SESSION['acces']);
            $json = json_encode($value);
            echo($json);
            return http_response_code(200);
        }
        else {
            $logout = new Logout();
            $logout->destroySession();
            return http_response_code(406);
        }
    }
}
?>
