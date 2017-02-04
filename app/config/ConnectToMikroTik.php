<?php
/**
 * Created by Martin Slavov
 */
namespace App\Config;

class ConnectToMikroTik {

    protected $host = "";
    protected $user = "";
	protected $port = "";
	protected $password = '';
	protected $con = null;
	private $log = '';
	protected $action ='';
	protected $numberOfRule  = '';
	protected $deleteUserForHotspot = '';
	protected $username_for_mikrotik = '';
	protected $password_for_mikrotik = '';
	protected $profile = 'LimitQuotes';

	function __construct($host='', $port=''  ) {

		if( $host!='' ) $this->host  = $host;
		if( $port!='' ) $this->port  = $port;
		$this->con  = ssh2_connect($this->host, $this->port);
		if( !$this->con ) {
		   $this->log .= "Connection failed !";
		}
	}
	
	function authPassword( $user = '', $password = '' ) {
		 if( $user!='' ) $this->user  = $user;
		 if( $password!='' ) $this->password  = $password;
		 if( !ssh2_auth_password( $this->con, $this->user, $this->password ) ) {
			$this->log .= "Authorization failed !";
		 }
	}
  
	function changeNatRuleMikrotik($action ='', $numberOfRule  = ''){
        $this->action  = $action;
        $this->numberOfRule  = $numberOfRule;
         if( !ssh2_exec( $this->con, "ip firewall nat $this->action numbers=$this->numberOfRule" ) ) {
         //if( !ssh2_exec( $this->con, "ip firewall nat $action numbers=$numberOfRule" ) ) {
        $this->log .= "Connot Execute !";
		}
	}

	function deleteUserFromMikrotik($deleteUserForHotspot = ''){
        $this->deleteUserForHotspot  = $deleteUserForHotspot;
		ssh2_exec( $this->con, "ip hotspot user remove $deleteUserForHotspot" ); 
	}

	function createUserInMikrotik($username_for_mikrotik = '', $password_for_mikrotik = ''){
        $this->username_for_mikrotik  = $username_for_mikrotik;
        $this->password_for_mikrotik  = $password_for_mikrotik;
		ssh2_exec( $this->con, "ip hotspot user add disabled=no name=$username_for_mikrotik password=$password_for_mikrotik profile=LimitQuotes server=hotspot1 limit-uptime=1d" ); 
	}

	function changeLimitSpeedOfUserInMikrotik($usernameForHotspot = '', $profileForHotspot = ''){
        $this->usernameForHotspot  = $usernameForHotspot;
        $this->profileForHotspot  = $profileForHotspot;
		ssh2_exec( $this->con, "ip hotspot user set $usernameForHotspot profile=$profileForHotspot" ); 
	}

	function closeMikrotikConnection(){
         if( !ssh2_exec( $this->con, "quit" ) ) {
        $this->log .= "Connot Execute !";
		}
	}

	function getLog() {
		return $this->log;
	}
}
