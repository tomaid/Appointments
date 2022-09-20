<?php
class AppointmentRepo {
    private $results;
    private $data;
    public function insertApp($connection=null, $user='', $medicId='', $data='') {
        $stmt = $connection->prepare("INSERT INTO appointments(medicid, pacientid, data, aprobareid) VALUES(?,?,?, 1)");
        $stmt->bind_param('iis', $medicId, $user, $data);
        try {
            $stmt->execute();
            return(true);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            return(false);
        }
        $stmt->close();
    }
    public function checkApp($connection=null, $medicId='', $oraStart='', $oraStop='') {
        $stmt = $connection->prepare("SELECT a.data 
        FROM appointments a
		WHERE a.medicid=? AND a.data BETWEEN ? AND ? ");
        $stmt->bind_param('iss', $medicId, $oraStart, $oraStop);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->data);
        $this->results = array();
        while ($stmt -> fetch())
        {
            $this->results[] = $this->data;
        }
        $stmt->close();
    }
    public function updateStatus($connection=null, $user='', $acces='', $appointmentid='', $status='') {
        if($acces==1)
            $stmt = $connection->prepare("UPDATE appointments SET aprobareid = ? WHERE id= ? AND pacientid= ?");
        if($acces==2)
            $stmt = $connection->prepare("UPDATE appointments SET aprobareid = ? WHERE id= ? AND medicid= ?");
        $stmt->bind_param('iis', $status, $appointmentid,$user);
        try {
            $stmt->execute();

            return(true);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            return(false);
        }
        $stmt->close();
    }

    public function listAllApp($connection=null, $user, $acces)
    {
        if($acces==1)
            $stmt = $connection->prepare("SELECT a.data, a.aprobareid, a.id, u.nume, u.prenume, u.user, u.tel
		FROM appointments a
        INNER JOIN users u ON 
        a.medicid=u.id
		WHERE a.pacientid = ? 
        order by a.data DESC");
        if($acces==2)
            $stmt = $connection->prepare("SELECT a.data, a.aprobareid, a.id, u.nume, u.prenume, u.user, u.tel
		FROM appointments a
        INNER JOIN users u ON 
        a.pacientid=u.id
		WHERE a.medicid = ?
        order by a.data DESC");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->dataap,$this->aprobareidap, $this->idap, $this->numeap, $this->prenumeap, $this->userap, $this->telap);
        $this->results = array();
        while ($stmt -> fetch())
        {
            $this->results[] = array($this->dataap,$this->aprobareidap, $this->idap, $this->numeap, $this->prenumeap, $this->userap, $this->telap);
        }

        $stmt->close();
    }
    public function getResults()
    {
        return $this->results;
    }
}
?>