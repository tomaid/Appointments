<?php
require_once '../config/db.class.php';
require_once '../repository/list-dangling-pointers-tables-referenced-tables-repo.php';
require_once 'sanitize.php';
class DanglingPointersReferencedTables {
    private mysqli $connection;
    private int $acces;
    private DanglingPointersReferencedTablesRepo $dataDB;

    public function __construct()
    {
        $db = new DB();
        $this->acces = $_SESSION['acces'];
        $this->connection = $db->conn();
        $this->dataDB = new DanglingPointersReferencedTablesRepo();
    }

    public function listReferencedDanglingPointers($tabela, $coloana)
    {
        $this->dataDB->listDanglingPointersRepo($this->connection,$tabela, $coloana);
        $listaDanglingPointers = $this->dataDB->getResults();
        if($listaDanglingPointers){
            foreach ($listaDanglingPointers as $subList){

                $value=array();
                $id = $coloana;
                $j_data = array();
                $n=0;
                foreach ($subList as $key => $value){
                    if($key === $id) {
                        $j_id = $value;
                    }
//                    else {
//                        if ($n > 0)
                            $j_data[] = $value;
                    // }
                    $n++;
                }
                $json_resp[] = array(
                    "id" => $j_id,
                    "date"=>substr(implode(', ',$j_data),0,60),
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