<?php
require_once '../config/db.class.php';
require_once '../repository/doctors.php';
class Doctors{
    private $connection;
    public function __construct()
    {
        $db = new DB();
        $this->connection = $db->conn();
    }
    public function listDoctors(){
        $dbLogin = new DoctorsRepo($this->connection);
        $doctorsDb = $dbLogin->getDoctors();
        if(isset($doctorsDb)) {
            foreach ($doctorsDb as $doctor) {
                $value[] = array(
                    "id" => $doctor[0],
                    "nume" => $doctor[1],
                    "prenume" => $doctor[2]);
            }
                $json = json_encode($value);
                echo($json);
                return http_response_code(200);
        }
        else {
            return http_response_code(406);
        }
        return http_response_code(406);
    }
}
?>
