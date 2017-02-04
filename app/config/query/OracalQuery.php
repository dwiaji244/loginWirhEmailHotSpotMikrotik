<?php
/**
 * Created by Martin Slavov
 */
namespace App\Config\Query;

use App\Config\Db;
use PDO;
use App\Inteface\IDatabaseConnectionable;
use App\Inteface\IQueryable;

require __DIR__ . '/../../../vendor/autoload.php';

class OracalQuery extends Db implements IDatabaseConnectionable,IQueryable{
	
	private static $instanceOracal; //The single instance
	protected $DBOracal;
	protected $dsn = 'mydb';
	protected $user = "";
	protected $pass = "";

	public function __construct() {

		try {
			$this->DBOracal = new PDO('oci:dbname=localhost/orcl;charset=CL8MSWIN1251', $this->user, $this->pass);
			$this->DBOracal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING, PDO::ERRMODE_EXCEPTION, PDO::ATTR_CONNECTION_STATUS);
		}
		catch (\PDOException $e) {
			echo '</br>'.'Error -1'.'</br>';
		}
	}
	
	public static function getInstanceOracal() {
		 if (!isset(self::$instanceOracal)) {
			self::$instanceOracal = new self();
        }
        return self::$instanceOracal;		
	}


	public function selectAll(){
		
		$query = "SELECT * FROM test";
		$stmt = $this->DBOracal->prepare($query);
        $stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

}