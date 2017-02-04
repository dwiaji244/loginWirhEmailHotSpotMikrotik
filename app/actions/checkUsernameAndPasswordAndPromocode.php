<?php 
/**
 * Created by Martin Slavov
 */
use App\Config\Query\MySQlQuery;

require __DIR__ . '/../../vendor/autoload.php';

	global $promocodeIsWrong;
	$username = $_POST['username'];
	$password = $_POST['password'];
	$promocode = $_POST['promocode'];

if (($username == 'hotspot' AND $password == 'hotspot') OR ($username == 'mslavov' AND $password == 'mslavov') 
                                                        OR ($username == 'martinslavov' AND $password == 'martinslavov'))
{
	//Username And Password For Еmployee
	
}
else
{
		$db =  MySQlQuery::getInstanceSingle();

		$rowH = $db->selectPromoCode($promocode, $table = 'promocode_highspeed');
		$rowHightSpeed = $rowH["promocode"];

		$rowM = $db->selectPromoCode($promocode, $table = 'promocode_middlespeed');
		$rowMiddleSpeed = $rowM["promocode"];

		$getUserAndPassForMikrotik = $db->selectUsernameAndPassword($username, $password, $table = 'username_for_mikrotik');
		$usernameForM = $getUserAndPassForMikrotik["username_for_mikrotik"];
		$passwordForM = $getUserAndPassForMikrotik["password_for_mikrotik"];

		$getUserAndPass = $db->selectMacWhereUsernameAndPassword($username, $password, $table = 'hotspot');
		$usernameIfExist = $getUserAndPass["username"];
		$passwordIfExist = $getUserAndPass["password"];

	if (empty($username) || empty($password)) 
	{
		//check if username and password are empty
		echo 'true';
	}
	elseif($usernameIfExist == $username || $passwordIfExist == $password)
	{
		//check username and password alredy used
		echo 'false';
	}
	elseif($usernameForM == $username && $passwordForM == $password)
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
			//$promocodeIsWrong = 'PromocodeIsEptyRight';
		}
		echo $promocodeIsWrong;
	}
	else
	{
		//Username Or Password is wrong
		echo 'UsernameOrPasswordIsWrong';
	}
}

