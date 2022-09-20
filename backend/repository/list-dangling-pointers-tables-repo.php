<?php
class DanglingPointersTablesRepo {
    private $results;
    private $level;
    private $code;
    private $message;
    private $dp;
    public function listTablesOnDB($connection) {
        $stmt = $connection->prepare("SELECT DISTINCT kcu.TABLE_NAME
FROM
     INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
         INNER JOIN
         INFORMATION_SCHEMA.COLUMNS c ON
             kcu.REFERENCED_TABLE_NAME = c.table_name
             AND 
             kcu.REFERENCED_COLUMN_NAME = c.column_name
WHERE
      REFERENCED_TABLE_SCHEMA LIKE 'proiect%'");
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->table);
        $this->results = array();
        while ($stmt -> fetch())
        {
            $this->results[] = array($this->table);
        }
        $stmt->close();
    }
    public function listColumnsOnTablesRepo($connection, $tabela) {
        $stmt = $connection->prepare("SELECT DISTINCT kcu.COLUMN_NAME
FROM
     INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
         INNER JOIN
         INFORMATION_SCHEMA.COLUMNS c ON
             kcu.REFERENCED_TABLE_NAME = c.table_name
             AND 
             kcu.REFERENCED_COLUMN_NAME = c.column_name
WHERE
      REFERENCED_TABLE_SCHEMA LIKE 'proiect%'
      AND
      kcu.TABLE_NAME = ?");
        $stmt->bind_param('s', $tabela);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->column);
        $this->results = array();
        while ($stmt -> fetch())
        {
            $this->results[] = array($this->column);
        }
        $stmt->close();
    }
    public function listDanglingPointersRepo($connection, $tabela, $coloana) {
        $stmt = $connection->prepare("SELECT DISTINCT kcu.table_schema, kcu.TABLE_NAME,kcu.COLUMN_NAME,kcu.CONSTRAINT_NAME, 
                kcu.REFERENCED_TABLE_NAME,kcu.REFERENCED_COLUMN_NAME, c.DATA_TYPE 
FROM
     INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
         INNER JOIN
         INFORMATION_SCHEMA.COLUMNS c ON
             kcu.REFERENCED_TABLE_NAME = c.table_name
             AND 
             kcu.REFERENCED_COLUMN_NAME = c.column_name
WHERE
      REFERENCED_TABLE_SCHEMA LIKE 'proiect%' 
  AND
      kcu.TABLE_NAME = ?
  AND 
      kcu.COLUMN_NAME = ?");
        $stmt->bind_param('ss', $tabela,$coloana);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->db, $this->table,$this->column,$this->constraint,$this->referencedtable,$this->referencedcolumn,$this->columntype);
        while ($stmt -> fetch())
        {
            // $this->results[] = array($this->db, $this->table,$this->column,$this->constraint,$this->referencedtable,$this->referencedcolumn,$this->columntype);
            $this->danglingPointersRow($connection, $this->column,$this->table,$this->referencedcolumn,$this->referencedtable);
        }
        $stmt->close();
    }
    public function danglingPointersRow($connection, $cv, $tv, $crv, $trv) {
        $sqlquery= "SELECT (SELECT DISTINCT kcu.COLUMN_NAME
FROM
     INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
WHERE
     TABLE_SCHEMA LIKE 'proiect%' 
    AND
      kcu.TABLE_NAME LIKE '".$tv."'
  AND 
	CONSTRAINT_NAME = 'PRIMARY') AS first_col, bl.* from ".$tv." bl 
LEFT OUTER JOIN ".$trv." a ON
bl.".$cv." = a.".$crv." WHERE a.".$crv." IS NULL";
        try {
            $stmt = $connection->prepare($sqlquery);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($data = $result->fetch_assoc()) {
                $this->results[] = array($data,$trv,$crv);
            }
            if($this->results)$this->count_results = count($this->results);
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