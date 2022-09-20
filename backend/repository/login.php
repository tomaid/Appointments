 <?php
class LoginUser {
	private $userid;
	private $pass;
    private $nume;
    private $prenume;
    private $telefon;
    private $tipcont;

	public function __construct($connection=null, $user='') {
		$this->user=$user;
		$stmt = $connection->prepare("SELECT u.id, u.pass, u.nume, u.prenume, u.tel, u.tipcont
		FROM users u
		WHERE u.user=? LIMIT 1");
		$stmt->bind_param('s', $this->user);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($this->userid, $this->pass, $this->nume, $this->prenume, $this->telefon, $this->tipcont);
		$stmt->fetch();
	  	$stmt->close();
	}
    public function getUserID(){
        return $this->userid;
    }
    public function getPass(){
        return $this->pass;
    }
    public function getNume(){
        return $this->nume;
    }
    public function getPrenume(){
        return $this->prenume;
    }
    public function getTelefon(){
        return $this->telefon;
    }
    public function getTipCont(){
        return $this->tipcont;
    }
	public function verifica_parola($parola){

		if (password_verify($parola, $this->pass))
	    {
	      return TRUE;
	    }
	    else
	    {
	      return FALSE;
		}
	}

}
?>