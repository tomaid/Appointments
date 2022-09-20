<?php
require_once '../config/db.class.php';
require_once '../repository/register.php';
require_once 'sanitize.php';
class Register {
    private $connection;
    private $user;
    private $pass;
    private $nume;
    private $prenume;
    private $telefon;
    private $tipcont;

    public function __construct($user ='', $pass = '', $nume ='', $prenume='', $telefon='', $tipcont=1)
    {
        $db = new DB();
        $this->connection = $db->conn();
        $sanitize = new Sanitize();
        $this->user = $sanitize->string($this->connection, $user);
        $this->nume = $sanitize->string($this->connection, $nume);
        $this->prenume = $sanitize->string($this->connection, $prenume);
        $this->telefon = $sanitize->string($this->connection, $telefon);
        $this->tipcont = (int) $sanitize->string($this->connection, $tipcont);
        $this->pass = $pass;
    }

    public function creareCont(){

           $dbRegister = new RegisterUser();
           $insertToDB = $dbRegister->insertToDB($this->connection,$this->user,$this->pass, $this->nume, $this->prenume, $this->telefon, $this->tipcont);

           if($insertToDB){
               session_start();
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['user'] = $this->user;
                $_SESSION['nume'] = $this->nume;
                $_SESSION['prenume'] = $this->prenume;
                $_SESSION['acces'] = $this->tipcont;
                $_SESSION['userid']= $dbRegister->getID($this->connection,$this->user);
                return http_response_code(200);
            }
            else{
                return http_response_code(406);
            }
    }
}
?>