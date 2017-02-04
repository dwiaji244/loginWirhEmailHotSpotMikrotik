<?php
/**
 * Created by Martin Slavov
 */
namespace App\Config\Query;

use App\Config\Db;
use PDO;
use App\Inteface\IDatabaseConnectionable;
use App\Inteface\IQueryable;

class MySQlQuery extends Db implements IDatabaseConnectionable,IQueryable{

	private static $instanceSingle; //The single instance

	public static function getInstanceSingle() {
		 if (!isset(self::$instanceSingle)) {
			self::$instanceSingle = new self();
        }
        return self::$instanceSingle;		
	}

	public function selectWithVariableOverride($email = ''){

		$result = $this->DBH->prepare('SELECT * FROM test WHERE email = :email');
		$result->execute(['email' => '']);
		return $result;

	}

	public function selectAll(){
		
		$result = $this->DBH->prepare('SELECT * FROM hotspot');
		$result->execute();
		return $result;
	}

	public function selectWithVariable($email = ''){

		$this->email = $email;
		$result = $this->DBH->prepare('SELECT * FROM test WHERE email = :email');
		$result->execute(['email' => $this->email]);
		return $result;

	}

	public function select(){

		$query = "SELECT * FROM test";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;

	}

	public function selectWithTwoVariable($email = '', $table = ''){

		$this->email = $email;
		$this->table = $table;

		$query = "SELECT * FROM $this->table WHERE email = :email";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['email' => $this->email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function checkIfEmailExist($email = '', $table = ''){

		$this->email = $email;
		$this->table = $table;

		$query = "SELECT email FROM $this->table WHERE email = :email";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['email' => $this->email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;


	}

	function selectUsernameFromHotspotNew($username = '', $table = ''){

		$this->username = $username;
		$this->table = $table;

		$query = "SELECT * FROM $this->table WHERE username = :username";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['username' => $this->username]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function selectEmailFromHotspotTable($mac = '', $table = ''){

		$this->mac = $mac;
		$this->table = $table;

		$query = "SELECT * FROM $this->table WHERE mac = :mac";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['mac' => $this->mac]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function selectUsernameFromUserForMikrotikNew($username_for_mikrotik = '', $table = ''){

		$this->username_for_mikrotik = $username_for_mikrotik;
		$this->table = $table;

		$query = "SELECT * FROM $this->table WHERE username_for_mikrotik = :username_for_mikrotik";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['username_for_mikrotik' => $this->username_for_mikrotik]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function selectWithTwoVariableWithMac($mac = '', $table = ''){

		$this->mac = $mac;
		$this->table = $table;

		$query = "SELECT * FROM $this->table WHERE mac = :mac";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['mac' => $this->mac]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function selectUsernameAndPassword($username = '', $password = '', $table = ''){

		$this->username = $username;
		$this->password = $password;
		$this->table = $table;

		$query = "SELECT * FROM $this->table WHERE  
				username_for_mikrotik = :username_for_mikrotik AND 
				password_for_mikrotik = :password_for_mikrotik";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['username_for_mikrotik' => $this->username, 'password_for_mikrotik' => $this->password]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

   function selectUsernameAndPasswordFromHotspot($username = '', $password = '', $table = ''){

		$this->username = $username;
		$this->password = $password;
		$this->table = $table;

		$query = "SELECT * FROM $this->table WHERE 
				username = :username AND 
				password = :password";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['username' => $this->username, 'password' => $this->password]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	public function selectUsernameAndPasswordAndMac($username = '', $password = '', $table = '', $mac = ''){

		$this->username = $username;
		$this->password = $password;
		$this->table = $table;
		$this->mac = $mac;

		$query = "SELECT * FROM $this->table WHERE mac = :mac AND 
				username = :username AND 
				password = :password";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['mac' => $this->mac, 'username' => $this->username, 'password' => $this->password]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function selectPromoCode($promocode = '', $table = '')
	{
		$this->promocode = $promocode;
		$this->table = $table;
		
		$query = "SELECT * FROM $this->table WHERE promocode = :promocode";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['promocode' => $this->promocode]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	function updateUsernameAndPassword($username = '', $password = '', $table = '', $mac = ''){

		$this->username = $username;
		$this->password = $password;
		$this->table = $table;
		$this->mac = $mac;

		$query = "UPDATE $this->table SET username = '". $this->username ."', password = '". $this->password ."' WHERE mac = :mac ";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['mac' => $this->mac]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	function updateUsernameAndPasswordAndPromocode($username = '', $password = '', $promocode = '', $table = '', $mac = ''){

		$this->username = $username;
		$this->password = $password;
		$this->promocode = $promocode;
		$this->table = $table;
		$this->mac = $mac;

		$query = "UPDATE $this->table SET username = '". $this->username ."', password = '". $this->password ."', promocode = '". $this->promocode ."' WHERE mac = :mac ";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['mac' => $this->mac]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function selectUsernameOlderThanSevenDays(){

		$query = "SELECT username_for_mikrotik FROM username_for_mikrotik WHERE date < DATE_SUB(NOW(), INTERVAL 7 DAY)";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;

	}

	function updateUsernameOlderThanSevenDays($usernameForDelete = '' ){

		$this->usernameForDelete = $usernameForDelete;

		$query = "UPDATE hotspot SET  username = '', password = '' WHERE username = :usernameForDelete";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['usernameForDelete' => $this->usernameForDelete]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	function deleteUsernameOlderThanSevenDays(){

		$query = "DELETE FROM username_for_mikrotik WHERE date < DATE_SUB(NOW(), INTERVAL 7 DAY)";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function selectUsernameOrderById($selectRow = '' , $table = '' ){

		$this->selectRow = $selectRow;
		$this->table = $table;

		$query = "SELECT $this->selectRow FROM $this->table order by id desc limit 1;";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function insertEmailTemplateIntoUsernameForMikrotik($username_for_mikrotik = '', $password_for_mikrotik = '', $date = '', $mac = '', $email = ''){

		$query = "INSERT INTO username_for_mikrotik ( username_for_mikrotik , password_for_mikrotik , date ,mac , email  ) VALUES ( '$username_for_mikrotik' , '$password_for_mikrotik' , '$date' , '$mac' , '$email' )";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function insertNumberOfEmailTemplate($email = '', $date = ''){

		$query = "INSERT INTO email_templates ( number_template , email , date  ) VALUES ( '1' , '$email' ,'$date' )";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function insertFromEmailTemplate($number_email_templates = '', $email = ''){

		$this->number_email_templates = $number_email_templates;
		$this->email = $email;

		$query = "INSERT INTO email_templates ( number_template , email  ) VALUES ( ':number_email_templates' , ':email'  )";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['number_email_templates' => $this->number_email_templates, 'email' => $this->email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function insertIntoHotspotUsernameAndPasswordAndMacAndIp($email = '', $date = '', $mac = '' ,$ip = ''){

		$query = "INSERT INTO hotspot ( email , date , mac , ip , username, firstname, lastname, password, promocode ) VALUES ( '$email' , '$date' , '$mac' , '$ip', '', '', '', '', '' )";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function checkIfUsernameAndPasswordExistAgainstMac($table = '', $mac = ''){

		$this->table = $table;
		$this->mac = $mac;

		$query = "SELECT * FROM $this->table WHERE mac = :mac";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['mac' => $this->mac]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function selectAndCheckIntoHotspotIfExist($username = '', $table = ''){

		$this->username = $username;
		$this->table = $table;

		$query = "SELECT * FROM $this->table WHERE username = :username";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['username' => $this->username]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	function selectMacWhereUsernameAndPassword($username = '', $password = '', $table = ''){

		$this->username = $username;
		$this->password = $password;
		$this->table = $table;

		$query = "SELECT mac FROM $this->table WHERE 
				username = :username AND 
				password = :password";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['username' => $this->username, 'password' => $this->password]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	function deleteFromTableUsernameOlderThanSevenDays($usernameForDelete = ''){

		$this->usernameForDelete = $usernameForDelete;

		$query = "DELETE FROM username_for_mikrotik WHERE username_for_mikrotik = :usernameForDelete";
		$stmt = $this->DBH->prepare($query);
        $stmt->execute(['usernameForDelete' => $this->usernameForDelete]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

}


