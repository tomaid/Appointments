<?php
class VerRefRepo {
    private array $results = array();
    private int $count_results;
    private bool $errors=false;
    private int $error_code;
    private string $error_message;


    public function __construct($connection, $cv, $tv, $crv, $trv) {
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
                $this->results[] = $data;
            }
            $this->count_results = count($this->results);
            $stmt->close();

        }catch (Exception $e) {
            $this->count_results = 0;
            $this->errors = true;
            $this->error_message = $e->getMessage();
            $this->error_code = $e->getCode();
        }
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @return int
     */
    public function getCountResults(): int
    {
        return $this->count_results;
    }

    /**
     * @return bool
     */
    public function isErrors(): bool
    {
        return $this->errors;
    }

    /**
     * @return int|mixed
     */
    public function getErrorCode(): mixed
    {
        return $this->error_code;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->error_message;
    }








}
?>