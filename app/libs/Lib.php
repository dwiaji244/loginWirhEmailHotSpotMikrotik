<?php
/**
 * Created by Martin Slavov
 */
namespace App\BaseLib;

class Lib {

	public function addLibHeader(){

		echo '<meta charset="utf-8">';
		echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">';
		echo '<title>Login Form</title>';

	}

	public function addLib(){

		echo '<link rel="stylesheet" href="public/css/style.css">';  
		echo '<script src="public/js/vendor/jquery-3.1.1.min.js"></script>';
		echo '<script src="public/js/validateEmailForLogin.js"></script>';
		echo '<script src="public/js/validateEmail.js"></script>';
		echo '<script src="public/js/checkUsernameAndPasswordAndPromoCode.js"></script>';
		echo '<script src="public/js/checkIfPromoCodeIsTyped.js"></script>';

	}
}
