<?php
require_once '../config/db.class.php';
require_once '../repository/foreignkeytext.php';
require_once 'sanitize.php';
class CheiStraineService {
    private mysqli $connection;
    private int $acces;
    private ForeignKeyText $dataDB;

    public function __construct()
    {
        $db = new DB();
        $this->acces = $_SESSION['acces'];
        $this->connection = $db->conn();
        $this->dataDB = new ForeignKeyText($this->connection);
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

    public function actualizareCheiStraine($bd,$col,$tab, $tab_referinta, $col_referinta, $constrangere)
    {
        $raspuns=$this->dataDB->modConstraints($this->connection, $bd,$col,$tab, $tab_referinta, $col_referinta, $constrangere);
        if($raspuns[0]===''){
            $raspuns_cod[] = array(
                "cod" => "200",
                "mesaj" => "Tabela a fost actualizata");
            $json = json_encode($raspuns_cod);
            echo($json);
            return http_response_code(200);
        }
        else{
            $raspuns_cod[] = array(
                "cod" => $raspuns[1],
                "mesaj" => $raspuns[2]);
            $json = json_encode($raspuns_cod);
            echo($json);
            if($raspuns[1]==1452) {
                return http_response_code(452);
            }

            else return http_response_code(406);
        }
    }
}
?>