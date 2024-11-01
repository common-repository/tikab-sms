<?php
	class Tikab_Webservice {
		private $wsdl_link = "http://87.107.121.54/post/Send.asmx?WSDL";
		public $unitrial = false;
		public $unit;
		public $flash = "disable";
		public $user;
		public $pass;
		public $from;
		public $to;
		public $msg;
		public $isflash = false;

		function __construct() {
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		function send_sms() {
		
			$client = new SoapClient($this->wsdl_link);
			
			$parameters = array(
				'username'	=>	$this->user,
				'password'	=>	$this->pass,
				'from'		=>	$this->from,
				'to'		=>	$this->to,
				'text'		=>	$this->msg,
				'isflash'	=>	$this->isflash,
				'udh'		=>	"",
				'recId'		=>	array(0),
				'status'	=>	0x0
			);
			
			if( $client->SendSms($parameters)->SendSmsResult == 1 )
				return true;
			else
				return false;
		}

		function get_credit() {
		
			$client = new SoapClient($this->wsdl_link);
			
			return $client->GetCredit(array("username" => $this->user, "password" => $this->pass))->GetCreditResult;
		}
	}
?>