<?php
/**
 * Created by Martin Slavov
 */
require __DIR__ . '/vendor/autoload.php';

use App\Config\Query\MySQlQuery;
use App\BaseController\Controller;
use App\BaseLib\Lib;

	$lib = new Lib();
	$lib->addLibHeader();

	$dates = date('y.m.d h:i:s');
	$mac = $_POST['mac'];
	$ip = $_POST['ip'];
	$mac = "70:F1:A1:2D:83:67";
	if(!$mac)
	{
		//Redirect
		header("Location: http://10.10.10.1/login.html");
	}
	else{

		$controller = new Controller();
		$controller->invoke($mac, $email, $ip);

		$lib->addLib();
	}
	