 <?php
class Sanitize {
	private $string;
	public function string($connection=null, $string='') {
		$this->string=$string;
		$this->string= strip_tags($this->string);
		$this->string = htmlentities($this->string);
		$this->string = str_replace("&icirc;", "î", $this->string);
  		$this->string = str_replace("&acirc;", "â", $this->string);
  		$this->string = str_replace("&Icirc;", "Î", $this->string);
  		$this->string = str_replace("&Acirc;", "Â", $this->string);
  		$this->string = str_replace("\r", " ", $this->string);
  		$this->string = str_replace("\n", " ", $this->string);
  		$this->string = str_replace(";", ",", $this->string);
		$this->string = stripslashes($this->string);
		$this->string = $connection->real_escape_string($this->string);
		return $this->string;
	}
}