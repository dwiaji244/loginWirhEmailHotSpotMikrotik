<?php
/**
 * Created by Martin Slavov
 */

use App\Config\Query\MySQlQuery;

require __DIR__ . '/../../vendor/autoload.php';
	
	$email = $_POST['email'];
	$mac = $_POST['mac'];
	$db =  MySQlQuery::getInstanceSingle();
	$row = $db->selectWithTwoVariable($email, $table = 'hotspot');

	if(isset($row["email"]))
	{
		echo 'false';
	}
	else
	{
		echo 'true';
	}


