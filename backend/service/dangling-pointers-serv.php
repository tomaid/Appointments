<?php
require_once '../config/db.class.php';
require_once '../repository/dangling-pointers-repo.php';
require_once 'sanitize.php';
class DanglingPointers {
    private mysqli $connection;
    private int $acces;
    private DanglingPointersRepo $dataDB;

    public function __construct()
    {
        $db = new DB();
        $this->acces = $_SESSION['acces'];
        $this->connection = $db->conn();
        $this->dataDB = new DanglingPointersRepo($this->connection);
    }
    public function listCheiStraine()
    {
        $listChei = $this->dataDB->getResults();
        if(isset($listChei)) {
            foreach ($listChei as $chei) {
                $value[] = array(
                    "baza_de_date" => $chei[0],
                    "tabela" => $chei[1],
                    "coloana" => $chei[2],
                    "constrangere" => $chei[3],
                    "tabela_referita" => $chei[4],
                    "coloana_referita" => $chei[5],
                    "tip_coloana" => $chei[6]);
            }
            $json = json_encode($value);
            echo($json);
            return http_response_code(200);
        }
        else {
            return http_response_code(406);
        }

    }
    public function listTables($bd=''){
        $listTabele = $this->dataDB->listTables($this->connection, $bd);
        if(isset($listTabele)) {
            foreach ($listTabele as $tabela) {
                $value[] = array(
                    "nume" => $tabela);
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
    public function listColumns($bd='',$table=''){
        $listColoane = $this->dataDB->listColumns($this->connection, $bd, $table);
        if(isset($listColoane)) {
            foreach ($listColoane as $coloana) {
                $value[] = array(
                    "nume" => $coloana);
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

    public function actualizareDanglingPointers($rand_id, $referinta, $tabela, $coloana, $coloana_nume)
    {
        $raspuns=$this->dataDB->actualizareDanglingPointersRepo($this->connection, $rand_id, $referinta, $tabela, $coloana, $coloana_nume);
        if($raspuns[0]== false){
            $raspuns_cod[] = array(
                "cod" => 200,
                "mesaj" => "Tabela a fost actualizata");
            $json = json_encode($raspuns_cod);
            echo($json);
            return http_response_code(200);
        }
        else{
                $raspuns_cod[] = array(
                    "cod" => $raspuns[1],
                    "mesaj" => $raspuns[1].', '.$raspuns[2]);
                $json = json_encode($raspuns_cod);
                echo($json);
                return http_response_code(406);
        }
    }
}
?>