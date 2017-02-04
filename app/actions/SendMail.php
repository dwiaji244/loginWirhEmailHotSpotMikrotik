<?php
/**
 * Created by Martin Slavov
 */
namespace App\Action;

require '../PHPMailer/PHPMailerAutoload.php';

class SendMail {

	public function SendMailForlogin($to, $message){
		
		$mail = new \PHPMailer();
		$mail->CharSet =  "utf-8";
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Username = "m";
		$mail->Password = "";
		$mail->SMTPSecure = "ssl";  
		$mail->Host = "smtp.gmail.com";
		$mail->Port = "";

		$mail->setFrom('martin.slavov89@gmail.com', 'Martin Slavov');
		$mail->AddAddress($to,$to);

		$mail->Subject  =  "Martin Slavov's HotSpot";
		$mail->IsHTML(true);
		$mail->Body = $message;
		// $mail->Body    = 'Hi there ,
							// // <br />
							// // this mail was sent using PHPMailer...
							// // <br />
							// // cheers... :)';
	  

		if($mail->send())
		{
			echo "Message was Successfully Send :)";
		}
		else
		{
			echo "Mail Error - >".$mail->ErrorInfo;
		} 

	}

	function sentEmail($username_for_mikrotik = '', $password_for_mikrotik = '')
	{
		$message = "
			<html>
			<head>
			</head>
			<body>
			Hello, 
			&nbsp;&nbsp;<p>These are your Login details:</p>
			&nbsp;&nbsp;&nbsp;&nbsp;<b>Username:</b>&nbsp;&nbsp;&nbsp;&nbsp; $username_for_mikrotik <br>
			&nbsp;&nbsp;&nbsp;&nbsp;<b>Password:</b>&nbsp;&nbsp;&nbsp;&nbsp; $password_for_mikrotik
			&nbsp;&nbsp;<p>Now you can use Martin Slavov's WiFi with one device. If you want to use network with other devices
				you have to repeat the same steps. If you have a question you can contact me by email.</p>
			<tr>
			<p>Best Regards,</p>
			</tr>
			</body>
			</html>
			";
		return $message;
	}

	function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
	{
		$sets = array();
		if(strpos($available_sets, 'l') !== false)
			$sets[] = 'abcdefghjkmnpqrstuvwxyz';
		if(strpos($available_sets, 'u') !== false)
			$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
		if(strpos($available_sets, 'd') !== false)
			$sets[] = '23456789';
		//if(strpos($available_sets, 's') !== false)
		//	$sets[] = '!@#$%&*?';
		$all = '';
		$password = '';
		foreach($sets as $set)
		{
			$password .= $set[array_rand(str_split($set))];
			$all .= $set;
		}
		$all = str_split($all);
		for($i = 0; $i < $length - count($sets); $i++)
			$password .= $all[array_rand($all)];
		$password = str_shuffle($password);
		if(!$add_dashes)
			return $password;
		$dash_len = floor(sqrt($length));
		$dash_str = '';
		while(strlen($password) > $dash_len)
		{
			$dash_str .= substr($password, 0, $dash_len) . '-';
			$password = substr($password, $dash_len);
		}
		$dash_str .= $password;
		return $dash_str;
		echo $dash_str;;
	}

}