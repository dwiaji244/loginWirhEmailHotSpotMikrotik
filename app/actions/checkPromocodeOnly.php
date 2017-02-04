<?php 
/**
 * Created by Martin Slavov
 */
use App\Config\Query\MySQlQuery;

require __DIR__ . '/../../vendor/autoload.php';

	global $promocodeIsWrong;
	$mac = $_POST['mac'];
	$promocode = $_POST['promocode'];

	$db =  MySQlQuery::getInstanceSingle();

	$rowH = $db->selectPromoCode($promocode, $table = 'promocode_highspeed');
	$rowHightSpeed = $rowH["promocode"];

	$rowM = $db->selectPromoCode($promocode, $table = 'promocode_middlespeed');
	$rowMiddleSpeed = $rowM["promocode"];

	$getUserAndPass = $db->selectWithTwoVariableWithMac($mac, $table = 'hotspot');
	$username = $getUserAndPass["username"];
	$password = $getUserAndPass["password"];

	$getUserAndPassForMikrotik = $db->selectUsernameAndPassword($username, $password, $table = 'username_for_mikrotik');
	$usernameForM = $getUserAndPassForMikrotik["username_for_mikrotik"];
	$passwordForM = $getUserAndPassForMikrotik["password_for_mikrotik"];

if($usernameForM != NULL && $passwordForM != NULL)
{

    if(($rowHightSpeed === $promocode) || ($rowMiddleSpeed === $promocode))
    {
        //$promocodeIsWrong = 'PromocodeIsRight';
    }
    elseif(($rowHightSpeed != $promocode) || ($rowMiddleSpeed != $promocode))  
    {
       $promocodeIsWrong = 'PromocodeIsWrong';
    }
	else
	{
		$promocodeIsWrong = 'PromocodeIsMissing';
	}
    echo $promocodeIsWrong;
}
else
{
    //Username Or Password is wrong
    echo 'PromocodeIsMissing';
}

