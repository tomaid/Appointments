<?php

class DB {

	private $host = HOST;
	private $db = DB;
	private $user = DBUSER;
	private $pass = DBPASSWORD;

	public function __construct() {
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
		if (!$connection) {
			die(SQL_CONNECTION_OFF);
		} 
		else {
			$connection->set_charset('utf8mb4');
			$connection->query('SET NAMES utf8mb4 COLLATE utf8mb4_romanian_ci');
			$connection->query('SET collation_connection = utf8mb4_romanian_ci');
			$this->myconn = $connection;
			// echo 'Există conexiune';
		}
	}
	public function conn(){
		return $this->myconn;
	}
}

?>
