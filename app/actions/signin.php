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
	$to = $email;

	$db =  MySQlQuery::getInstanceSingle();
	$row = $db->selectWithTwoVariable($email, $table = 'hotspot');

	if(isset($row["email"]))
	{
		//Email Already Exist
		echo "ERORR -1101";
	}
	else
	{
		$insert = $db->insertIntoHotspotUsernameAndPasswordAndMacAndIp($email, $date, $mac ,$ip);
		//Mikrotik Connection
		$connectionToMikrotik = new ConnectToMikroTik(); 
		$connectionToMikrotik->__construct();
		$connectionToMikrotik->authPassword();

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
			echo $message;
		}
		else
		{
			$selectFromTemplates = $db->selectUsernameOrderById($selectRow = 'number_template' , $table = 'email_templates' );

			if ($selectFromTemplates["number_template"] > 19 )
			{
			   
				$insertNumberOfEmailTemplate=$myClassObj->insertNumberOfEmailTemplate();
				$selectUsernameForMikrotikOrderById=$myClassObj->selectUsernameOrderById($selectRow = 'number_template' , $table = 'email_templates' );
				$row = mysqli_fetch_row($selectUsernameForMikrotikOrderById);
				$number_email_templates = $row[0];
			}
			$id = $selectFromTemplates["number_template"];
			$messageid = $id.".html";

			$myMessageContent = file_get_contents('../../app/views/emailTemplates/signature.html');
			$myEmailContent = file_get_contents("../../app/emails/readyEmails/$messageid");
			$message = $myEmailContent;
			$message .= $myMessageContent;

			$mailSended = $mailer->SendMailForlogin($to, $message);

			$number_email_templates = $id + 1;
			$insertEmailTemplate = $db->insertFromEmailTemplate($number_email_templates , $email );   
				
			}
		header("Location: http://hotspot.tk/php/login.php?mac=$mac&ip=$ip&email=$email"); 
	}
