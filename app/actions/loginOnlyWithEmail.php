<?php
/**
 * Created by Martin Slavov
 */
use App\Config\Query\MySQlQuery;

require __DIR__ . '/../../vendor/autoload.php';

	$mac = $_POST['mac'];
	$email = $_POST['textEmail'];

	$db =  MySQlQuery::getInstanceSingle();

	$getUserAndPass = $db->selectWithTwoVariableWithMac($mac, $table = 'hotspot');
	$username = $getUserAndPass["username"];
	$password = $getUserAndPass["password"];

	$username1 = 'lowestSpeed';
	$password1 = 'lowestSpeed'; 

if ($username != NULL && $password != NULL) 
{ 
	header("location: http://10.10.10.1/login?username=$username&password=$password");
}
else
{
	header("location: http://10.10.10.1/login?username=$username1&password=$password1");
}