<?php
/**
 * Created by Martin Slavov
 */
namespace App\BaseController;
	
use App\BaseModel\Model;
use App\BaseView\View;
use App\Config\Query\MySQlQuery;

/**
* Base controller
*/

class Controller 
{
	 
	public $model;
	public $view;
	 
	public function __construct()  
	{  
		$this->model = new Model();
		$this->view = new View();

	} 
	
	public function invoke($mac, $email, $ip)
	{  

		echo $mac;
		$db =  MySQlQuery::getInstanceSingle();
		$row = $db->checkIfUsernameAndPasswordExistAgainstMac($table = 'hotspot', $mac);
		$macFromHotspot = $row["mac"];
		$usernameFromHotspot = $row["password"];
		$passwordFromHotspot = $row["password"];
		$promocodeFromHotspot = $row["promocode"];

		$reslt = $this->model->getlogin();   

		if(($usernameFromHotspot != NULL) && 
			   ($passwordFromHotspot != NULL) && 
			   ($macFromHotspot != NULL) && 
			   ($promocodeFromHotspot == 'highSpeed')){	
		
			header("location: http://10.10.10.1/login?username=$usernameFromHotspot&password=$passwordFromHotspot");
			
		}
		elseif(($usernameFromHotspot != NULL) && 
			   ($passwordFromHotspot != NULL) && 
			   ($macFromHotspot != NULL)){

			$db =  MySQlQuery::getInstanceSingle();
			$row = $db->checkIfUsernameAndPasswordExistAgainstMac($table = 'hotspot', $mac);
			$email = $row["email"];

			$footerDate=$this->view->renderLayout('footer', array());
			$headerDate=$this->view->renderLayout('header', array());
			$bodyDate=$this->view->render('forms/promocode', array('mac_variable' => $mac,
																   'ip' => $ip,
																   'email' => $email));

			echo $this->view->renderLayout('main', array('footer' => $footerDate,
														 'header' => $headerDate,
														 'content' => $bodyDate,));									 
														 
		}
		elseif(($usernameFromHotspot == NULL) && 
			   ($passwordFromHotspot == NULL) && 
			   ($macFromHotspot != NULL)){

			$db =  MySQlQuery::getInstanceSingle();
			$row = $db->checkIfUsernameAndPasswordExistAgainstMac($table = 'hotspot', $mac);
			$email = $row["email"];

			$footerDate=$this->view->renderLayout('footer', array());
			$headerDate=$this->view->renderLayout('header', array());
			$bodyDate=$this->view->render('forms/usernameAndPasswordAndPromocode', array('mac_variable' => $mac,
																   'ip' => $ip,
																   'email' => $email));

			echo $this->view->renderLayout('main', array('footer' => $footerDate,
														 'header' => $headerDate,
														 'content' => $bodyDate,));
		}
		else 
		{

			$headerDate=$this->view->renderLayout('header', array());
			$footerDate=$this->view->renderLayout('footer', array());
			$bodyDate=$this->view->render('forms/email', array('mac_variable' => $mac,
															   'ip' => $ip));

			echo $this->view->renderLayout('main', array('header' => $headerDate,
														 'footer' => $footerDate,
														 'content' => $bodyDate,));		

		}
	}
}


    