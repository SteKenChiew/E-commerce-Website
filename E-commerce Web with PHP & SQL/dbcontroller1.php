<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "userdb";
	private $conn;

	function __construct() {
		$attr = "mysql:host=". $this->host .";dbname=". $this->database;
		$opts =
		[
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$this->conn = new PDO($attr, $this->user, $this->password, $opts);
	}
	
	function runQuery($query) {
		$result = $this->conn->query($query);
		while($row=$result->fetch()) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  =   $this->conn->query($query);
		$rowcount = $result->rowCount();
		return $rowcount;	
	}
}
?>

