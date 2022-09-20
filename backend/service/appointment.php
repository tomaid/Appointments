<?php
require_once '../config/db.class.php';
require_once '../repository/appointment.php';
require_once 'sanitize.php';
class AppointmentService {
    private mysqli $connection;
    private string $user;
    private int $medicId;
    private string $data;
    private AppointmentRepo $dataDB;
    private string $oraStart;
    private string $oraStop;
    private int $status;
    private int $appointmentid;
    private int $acces;

    public function __construct($user=0, $medicId=0,  $dat='', $ora=0, $oraStart=8, $oraStop=17, $appointmentid=0, $status=1)
    {
        $db = new DB();
        $this->acces = $_SESSION['acces'];
        $this->connection = $db->conn();
        $sanitize = new Sanitize();
        $this->user=$user;
        $this->medicId = (int)$sanitize->string($this->connection, $medicId);
        $this->data=date('Y-m-d H:i:s', strtotime($sanitize->string($this->connection, $dat) . " " . $sanitize->string($this->connection, $ora . ":00:00" )));
        $this->oraStart=date('Y-m-d H:i:s', strtotime($sanitize->string($this->connection, $dat) . " " . $sanitize->string($this->connection, $oraStart . ":00:00" )));
        $this->oraStop=date('Y-m-d H:i:s', strtotime($sanitize->string($this->connection, $dat) . " " . $sanitize->string($this->connection, $oraStop . ":00:00" )));
        $this->status= $sanitize->string($this->connection, $status);

        $this->appointmentid= $sanitize->string($this->connection, $appointmentid);
        $this->dataDB = new AppointmentRepo();
    }
    public function insert(){
        if($this->dataDB->insertApp($this->connection,$this->user, $this->medicId, $this->data)){
            return http_response_code(200);
        }
        else{
            return http_response_code(406);
        }
    }
    public function check(){

        $this->dataDB->checkApp($this->connection,$this->medicId, $this->oraStart, $this->oraStop);
        $checkApp = $this->dataDB->getResults();
        if($checkApp) {

            foreach ($checkApp as $appointment) {
                $value[] =(int)date('H', strtotime($appointment));
            }
            $json = json_encode($value);
            echo($json);
            return http_response_code(200);
        }
        else {
            return http_response_code(406);
        }
    }
    public function changeStatus(){
        if($this->dataDB->updateStatus($this->connection,$this->user, $this->acces, $this->appointmentid, $this->status)){
            return http_response_code(200);
        }
        else{
            return http_response_code(406);
        }
    }
    public function listAll(){
        $this->dataDB->listAllApp($this->connection,$this->user,$this->acces);

        $checkApp = $this->dataDB->getResults();
        if(isset($checkApp)) {

            foreach ($checkApp as $appointment) {
               $datafromdql= strtotime($appointment[0]);
                $value[] = array(
                    "date_sort" => date('YmdH', $datafromdql),
                    "date_app" => date('d/m/Y H:i', $datafromdql),
                    "idap" => $appointment[2],
                    "aprobap" => $appointment[1],
                    "emailap" => $appointment[5],
                    "telap" => $appointment[6],
                    "numeap" => $appointment[3],
                    "prenumeap" => $appointment[4]);
            }
            $json = json_encode($value);
            echo($json);
            return http_response_code(200);
        }
        else {
            return http_response_code(406);
        }
    }
}
?>