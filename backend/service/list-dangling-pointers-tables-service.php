<?php
require_once '../config/db.class.php';
require_once '../repository/list-dangling-pointers-tables-repo.php';
require_once 'sanitize.php';
class DanglingPointersTables {
    private mysqli $connection;
    private int $acces;
    private DanglingPointersTablesRepo $dataDB;

    public function __construct()
    {
        $db = new DB();
        $this->acces = $_SESSION['acces'];
        $this->connection = $db->conn();
        $this->dataDB = new DanglingPointersTablesRepo();
    }
    public function listDanglingPointersTables()
    {
        $this->dataDB->listTablesOnDB($this->connection);
        $listTables = $this->dataDB->getResults();
        if(isset($listTables)) {
            foreach ($listTables as $tabela) {
                $value[] = array(
                    "tabela" => $tabela);
            }
            $json = json_encode($value);
            echo($json);
            return http_response_code(200);
        }
        else {
            return http_response_code(406);
        }

    }
    public function listColumnsOnTables($numeTabela='')
    {
        $this->dataDB->listColumnsOnTablesRepo($this->connection,$numeTabela);
        $listTables = $this->dataDB->getResults();
        if(isset($listTables)) {
            foreach ($listTables as $tabela) {
                $value[] = array(
                    "coloana" => $tabela);
            }
            $json = json_encode($value);
            echo($json);
            return http_response_code(200);
        }
        else {
            return http_response_code(406);
        }

    }

    public function listDanglingPointers($tabela, $coloana)
    {
        $this->dataDB->listDanglingPointersRepo($this->connection,$tabela, $coloana);
        $listaDanglingPointers = $this->dataDB->getResults();
        if($listaDanglingPointers){
            foreach ($listaDanglingPointers as $subLists){
                $subList=$subLists[0];
                    $value=array();
                    $id = $subList[array_keys($subList)[0]];
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
                        "date"=>substr(implode(', ',$j_data),0,60),
                        "tabela"=>$subLists[1],
                        "coloana"=>$subLists[2],
                        "coloana_id"=>$id
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
}
?>