<?php
/**
 * Created by Martin Slavov
 */
use App\Config\Query\MySQlQuery;
use App\Config\ConnectToMikroTik;
use App\Action\SendMail;

	require __DIR__ . '/../../vendor/autoload.php';

	$email = $_POST['email'];
	$date = date('y.m.d h:i:s');
	$mac = $_POST['mac'];
	$ip = $_POST['ip'];

	$connectionToMikrotik = new ConnectToMikroTik(); 
	$connectionToMikrotik->__construct();
	$connectionToMikrotik->authPassword();

	$db =  MySQlQuery::getInstanceSingle();
	$row = $db->selectWithTwoVariable($email, $table = 'hotspot');
	$getEmail = $db->selectEmailFromHotspotTable($mac, $table = 'hotspot');
	$to = $getEmail["email"];

	if ($connectionToMikrotik) 
	{   
		$mailer = new SendMail();
		$password_for_mikrotik = $mailer->generateStrongPassword(6);
		$selectUserById = $db->selectUsernameOrderById($selectRow = 'username_for_mikrotik' , $table = 'username_for_mikrotik' );
		$username_for_mikrotik = $selectUserById["username_for_mikrotik"];
		$username_for_mikrotik ++;
		// Mikrotik Action
		$connectionToMikrotik->createUserInMikrotik($username_for_mikrotik, $password_for_mikrotik);
		$connectionToMikrotik->closeMikrotikConnection();

		$insertUserAndPassForMikrotik = $db->insertEmailTemplateIntoUsernameForMikrotik($username_for_mikrotik, $password_for_mikrotik, $date);

		$messageid = $username_for_mikrotik.".html";	
		$message = $mailer->sentEmail($username_for_mikrotik, $password_for_mikrotik);
		$message .= file_get_contents('../../app/views/emailTemplates/signature.html');
		file_put_contents("../../app/emails/$messageid", $message);
		$mailSended = $mailer->SendMailForlogin($to, $message);
		echo "dada";
	}
	else
	{
		//TO DO
		
	}

	if($email != $getEmail["email"])
	{
		//Email Already Exist
		$selectUserById = $db->insertIntoHotspotUsernameAndPasswordAndMacAndIp($email, $date, $mac, $ip);
	}

	header("Location: http://10.10.10.1/login.html");