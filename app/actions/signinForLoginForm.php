<?php
/**
 * Created by Martin Slavov
 */

use App\Config\Query\MySQlQuery;
use App\Config\ConnectToMikroTik;

require __DIR__ . '/../../vendor/autoload.php';

	$promocode = $_POST['promocode'];
	$mac = $_POST['mac'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$db =  MySQlQuery::getInstanceSingle();
	$getUserAndPassAndMac = $db->selectUsernameAndPasswordAndMac($username, $password, $table = 'hotspot', $mac);
	$usernameIfExist = $getUserAndPassAndMac["username"];
	$passwordIfExist = $getUserAndPassAndMac["password"];
	$macIfExist = $getUserAndPassAndMac["mac"];
		
	$getUserAndPass = $db->selectUsernameAndPassword($username, $password, $table = 'username_for_mikrotik');
	$usernameForH = $getUserAndPass["username_for_mikrotik"];
	$passwordForH = $getUserAndPass["password_for_mikrotik"];

if(($usernameForH != NULL && $passwordForH!= NULL) && ($usernameIfExist == NULL && $passwordIfExist == NULL))
{
	if ($promocode != "")
	{
		$rowH = $db->selectPromoCode($promocode, $table = 'promocode_highspeed');
		$rowHightSpeed = $rowH["promocode"];

		$rowM = $db->selectPromoCode($promocode, $table = 'promocode_middlespeed');
		$rowMiddleSpeed = $rowM["promocode"];

		if($rowHightSpeed == $promocode)
		{
			//Mikrotik Connection and change speed limit to highspeed
			$connectionToMikrotik = new ConnectToMikroTik(); 
			$connectionToMikrotik->__construct();
			$connectionToMikrotik->authPassword();
			$connectionToMikrotik->changeLimitSpeedOfUserInMikrotik($username, $profile = 'HighQuotes');
			$connectionToMikrotik->closeMikrotikConnection();

			$updateAll=$db->updateUsernameAndPasswordAndPromocode($username , $password , $promocode = 'highSpeed', $table = 'hotspot', $mac );
			header("location: http://10.10.10.1/login?username=$username&password=$password");
		}
		elseif($rowMiddleSpeed == $promocode)

		{ 
			//Mikrotik Connection and change speed limit to middlesspeed
			$connectionToMikrotik = new ConnectToMikroTik(); 
			$connectionToMikrotik->__construct();
			$connectionToMikrotik->authPassword();
			$connectionToMikrotik->changeLimitSpeedOfUserInMikrotik($username, $profile = 'MiddleQuotes');
			$connectionToMikrotik->closeMikrotikConnection();

			$updatePromocode=$db->updateUsernameAndPasswordAndPromocode($username , $password , $promocode , $table = 'hotspot', $mac );
			header("location: http://10.10.10.1/login?username=$username&password=$password");
		}
		else
		{	//Removed
			//header("Location: ../view/promocodeIsIncorrect.php");
			echo "ERROR -1002";
		}
	}        
    else
    {
            $updateUserAndPass = $db->updateUsernameAndPassword($usernameForH, $passwordForH, $table = 'hotspot', $mac);
            header("location: http://10.10.10.1/login?username=$usernameForH&password=$passwordForH");
    }
}
else
{
	echo "ERROR -1001";
}
