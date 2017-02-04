<?php
/**
 * Created by Martin Slavov
 */
use App\Config\Query\MySQlQuery;
use App\Config\ConnectToMikroTik;

require __DIR__ . '/../../vendor/autoload.php';

	$db =  MySQlQuery::getInstanceSingle();

	$row = $db->selectUsernameOlderThanSevenDays();


if($row[0]["username_for_mikrotik"]){

	$connectionToMikrotik = new ConnectToMikroTik(); 
	$connectionToMikrotik->__construct();
	$connectionToMikrotik->authPassword();
	foreach ($row as $rows){
		
		$i += 1;
		$usernameForDelete = $row[$i-1]["username_for_mikrotik"];
		
		$connectionToMikrotik->deleteUserFromMikrotik($usernameForDelete);
		$updateUsernam = $db->updateUsernameOlderThanSevenDays($usernameForDelete);
		$deleteUsernam = $db->deleteUsernameOlderThanSevenDays($usernameForDelete);
	}
		$connectionToMikrotik->closeMikrotikConnection();

}

