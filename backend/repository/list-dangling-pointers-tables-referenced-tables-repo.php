<?php
class DanglingPointersReferencedTablesRepo {
    private $results;
    private $level;
    private $code;
    private $message;
    private $dp;
    public function listDanglingPointersRepo($connection, $trv, $crv) {
        $sqlquery= "SELECT bl.* from ".$trv." bl";

        try {
            $stmt = $connection->prepare($sqlquery);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($data = $result->fetch_assoc()) {
                $this->results[] = $data;
            }
            $stmt->close();

        }catch (Exception $e) {
            $this->errors = true;
            $this->error_message = $e->getMessage();
            $this->error_code = $e->getCode();
        }
    }
    public function getResults()
    {
        return $this->results;
    }


}
?>