<?php
require_once '../config/db.class.php';
require_once '../repository/verifReferintaRepository.php';
require_once 'sanitize.php';
class VerificaReferinta {
    private mysqli $connection;
    private int $acces;
    private VerRefRepo $dataDB;
    private $cv;
    private $tv;
    private $crv;
    private $trv;

    public function __construct($cv,$tv,$crv,$trv)
    {
        $db = new DB();
        $this->acces = $_SESSION['acces'];
        $this->connection = $db->conn();
        $sanitize = new Sanitize();
        $this->cv = $sanitize->string($this->connection, $cv);
        $this->tv = $sanitize->string($this->connection, $tv);
        $this->crv = $sanitize->string($this->connection, $crv);
        $this->trv = $sanitize->string($this->connection, $trv);
        $this->dataDB = new VerRefRepo($this->connection, $this->cv, $this->tv, $this->crv, $this->trv);
    }
    public function list()
    {
        $json_resp = array();
        $listRef = $this->dataDB->getResults();
        if(!$this->dataDB->isErrors()) {
            if($this->dataDB->getCountResults()>0){
                foreach ($listRef as $subList){
                    $value=array();
                    $id = $subList[ array_keys($subList)[0]];
                    $j_data = array();
                    $n=0;
                    foreach ($subList as $key => $value){
                        if($key === $id) {
                            $j_id = $value;
                        }
                        else{
                            if($n>0)
                                $j_data[] = $value;
                        }
                        $n++;
                    }
                    $json_resp[] = array(
                        "id" => $j_id,
                        "date"=>substr(implode(', ',$j_data),0,60)
                    );
                }
                $json = json_encode($json_resp);
                echo($json);
                return http_response_code(200); // exista dangling pointers
            }
            else{
                $j_id = 0001;
                $j_data = "Nu exista dangling pointers.";
                $json_resp[] = array(
                    "id" => $j_id,
                    "date"=>$j_data
                );
                $json = json_encode($json_resp);
                echo($json);
                return http_response_code(453); // nu exista dangling pointers
            }

        }
        else {
            $json_resp[] = array(
                "code" => $this->dataDB->getErrorCode(),
                "message"=>$this->dataDB->getErrorMessage()
            );
            $json = json_encode($json_resp);
            echo($json);
            return http_response_code(406); // a aparut o eroare in baza de date
        }
    }
}
?>