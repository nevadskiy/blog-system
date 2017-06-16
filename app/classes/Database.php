<?php 

namespace App\classes;

class Database extends \PDO {

	private $DBconfig;

	public function __construct() {

		$this->DBconfig = $GLOBALS['config']['database'];

		$dsn = $this->DBconfig['DB_TYPE'] . ":host=" . $this->DBconfig['DB_HOST'] . ";dbname=" . $this->DBconfig['DB_NAME'];
		$username = $this->DBconfig['username'];
		$password = $this->DBconfig['password'];

		try {
			parent::__construct($dsn, $username, $password);
			$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (\PDOException $e) {
			echo $e->getMessage();
			exit();
		}
	}
}

 ?>