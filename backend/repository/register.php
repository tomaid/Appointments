<?php
class RegisterUser {
	public function insertToDB($connection,$user,$pass, $nume, $prenume, $telefon,$tipcont) {
        $stmt = $connection->prepare("INSERT INTO users(user, pass, nume, prenume, tel, tipcont) VALUES(?,?,?,?,?,?)");
		$stmt->bind_param('sssssi', $user, $pass, $nume, $prenume, $telefon, $tipcont);
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
    public function getID($connection,$user) {
        $stmt = $connection->prepare("SELECT id FROM users WHERE user = ?");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->id);
        $stmt->fetch();
        $stmt->close();
        return($this->id);
    }
}
?>