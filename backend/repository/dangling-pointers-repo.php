<?php
require_once 'verifReferintaRepository.php';
class DanglingPointersRepo {
    private $results;
    private $level;
    private $code;
    private $message;
    public function __construct($connection=null) {
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
      kcu.TABLE_NAME LIKE 'biblioteca_%'");
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->db, $this->table,$this->column,$this->constraint,$this->referencedtable,$this->referencedcolumn,$this->columntype);
        $this->results = array();
        while ($stmt -> fetch())
        {
            $this->results[] = array($this->db, $this->table,$this->column,$this->constraint,$this->referencedtable,$this->referencedcolumn,$this->columntype);
        }
        $stmt->close();
    }
    public function getResults()
    {
        return $this->results;
    }

    public function listTables($connection, $bd=''){
        $stmt = $connection->prepare("SELECT DISTINCT kcu.TABLE_NAME
FROM
     INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
WHERE
      kcu.TABLE_SCHEMA = ?");
        $stmt->bind_param('s', $bd);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->table);
        $this->tb = array();
        while ($stmt -> fetch())
        {
            $this->tb[] = $this->table;
        }
        $stmt->close();
        return $this->tb;


    }
    public function listColumns($connection, $bd='', $table=''){
        $stmt = $connection->prepare("SELECT DISTINCT kcu.COLUMN_NAME
FROM
     INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
    INNER JOIN INFORMATION_SCHEMA.COLUMNS c ON
  kcu.COLUMN_NAME = c.column_name
WHERE
      kcu.TABLE_SCHEMA = ?
AND
      kcu.TABLE_NAME = ?
AND c.DATA_TYPE LIKE 'int'");
        $stmt->bind_param('ss', $bd, $table);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->table);
        $this->tb = array();
        while ($stmt -> fetch())
        {
            $this->tb[] = $this->table;
        }
        $stmt->close();
        return $this->tb;


    }

    public function modConstraints($connection, $bd,$col,$tab, $tab_referinta, $col_referinta, $constrangere)
    {
        $danglingPointers = new VerRefRepo($connection,$col,$tab,$col_referinta,$tab_referinta);
        $countdangling = $danglingPointers->getCountResults();
        if($countdangling>0){
            return array('Error', 1452, 'Exista dangling pointers. Rezolvati dangling pointers inainte si reveniti.');
        }else{
            $tabela = $bd . "." . $tab;
            $tabelaReferinta = $bd . "." . $tab_referinta;
            $stmt = $connection->prepare("call modificare_foreign_key(?, ?, ?, ?, ?) ");
            $stmt->bind_param('sssss', $tabela, $col, $tabelaReferinta, $col_referinta, $constrangere);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($this->level, $this->code, $this->message);
            $stmt->fetch();
            return array($this->level, $this->code, $this->message);
            $stmt->close();
        }
    }
    public function actualizareDanglingPointersRepo($connection, $rand_id, $referinta, $tabela, $coloana, $coloana_nume)
    {
        $sqlquery = "UPDATE ".$tabela." SET ".$coloana."= ? WHERE ".$coloana_nume." = ?";
        try {
            $stmt = $connection->prepare($sqlquery);
            $stmt->bind_param('ss', $referinta, $rand_id);
            $stmt->execute();
            $stmt->close();
            $this->errors = false;
            $this->error_message = "";
            $this->error_code ="";
            return array(false,"","");

        }catch (Exception $e) {
            return array(true,$e->getCode(),$e->getMessage());
        }
    }

}
?>