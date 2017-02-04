<?php
/**
 * Created by Martin Slavov
 */
namespace App\BaseModel;

use App\Config\Query\MySQlQuery;

/**
* Base model
*/

class Model 
{
	public $database;
	public $username;
	public $password;
	
	public function getlogin()
	{				
		
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$this->database = MySQlQuery::getInstanceSingle();
			$row = $this->database->selectUsernameAndPassword($username, $password, $table = 'hotspot');
				
			foreach($row as $pdo){
				 $username = $pdo['first'];
				 $password = $pdo['last'];
			}
			
			if($_POST['username']==$username && $_POST['password']==$password)
			{
				$this->database = Database::getInstance();
				$insert = $this->database->insert();
				return 'login';
			}
			else
			{
				return 'invalid user';
			}
		}
	}
}

