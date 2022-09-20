<?php
class DoctorsRepo {
    private $userid;
    private $nume;
    private $prenume;
    private $tipcont;
    private $results;

    public function __construct($connection=null, $tipcont=2) {
        $this->tipcont=$tipcont;
        $stmt = $connection->prepare("SELECT u.id, u.nume, u.prenume
		FROM users u
		WHERE u.tipcont=?");
        $stmt->bind_param('i', $this->tipcont);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->userid, $this->nume, $this->prenume);
        $this->results = array();
        while ($stmt -> fetch())
        {
            $this->results[] = array($this->userid, $this->nume, $this->prenume);
        }
        $stmt->close();
    }
    public function getDoctors(){
        return $this->results;
    }

}
?>