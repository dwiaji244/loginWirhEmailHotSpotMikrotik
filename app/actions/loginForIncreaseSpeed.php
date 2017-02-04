<?php
/**
 * Created by Martin Slavov
 */
use App\Config\Query\MySQlQuery;
use App\Config\ConnectToMikroTik;

require __DIR__ . '/../../vendor/autoload.php';

		$email = $_POST['email'];
		$promocode = $_POST['promocode'];
		$date = date('y.m.d h:i:s');
		$mac = $_POST['mac'];
		$ip = $_POST['ip'];

		$db =  MySQlQuery::getInstanceSingle();

		$getUserAndPass = $db->selectWithTwoVariableWithMac($mac, $table = 'hotspot');
		$username = $getUserAndPass["username"];
		$password = $getUserAndPass["password"];

		$rowH = $db->selectPromoCode($promocode, $table = 'promocode_highspeed');
		$rowHightSpeed = $rowH["promocode"];

		$rowM = $db->selectPromoCode($promocode, $table = 'promocode_middlespeed');
		$rowMiddleSpeed = $rowM["promocode"];

if ($promocode != "")
{
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
             {		//Removed
                    header("Location: ../view/promocodeIsIncorrect.php");
             }
}        
elseif ($username != 0 && $password != 0) 
{ 
    header("location: http://10.10.10.1/login?username=$username&password=$password");
}
else
{
    header("Location: http://10.10.10.1/login.html");
} 