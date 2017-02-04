<?php
/**
 * Created by Martin Slavov
 */
namespace App\Config;
use PDO;

class Db {

	private static $instance; //The single instance
	protected $DBH;
	protected $dsn = 'mydb';
	protected $user = "";
	protected $pass = "";

	public function __construct() {

		try {
			$this->DBH = new PDO($this->dsn, $this->user, $this->pass);
			$this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING, PDO::ERRMODE_EXCEPTION, PDO::ATTR_CONNECTION_STATUS);
		}
		catch (\PDOException $e) {
			echo '</br>'.'Error -1'.'</br>';
		}
	}
	
	public static function getInstance() {
		 if (!isset(self::$instance)) {
			self::$instance = new self();
        }
        return self::$instance;		
	}

	public function closeConnection() {

		$this->DBH = null;
	}
	public function selectWithVariableOverride($email = ''){
		
		$this->email = $email;
		$result = $this->DBH->prepare('SELECT * FROM test WHERE email = :email');
		$result->execute(['email' => $this->email]);
		return $result;
    }
}
