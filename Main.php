<?php
	namespace Dev\Main;
	use Dev\Auth\Auth as auth;


	Class Main
	{
		public $entry_object;
		public $auth_class;
		public $access_token;
		public $con;
		function __construct($para, $pass)
		{
			$auth = new auth();
			if($para)	{
				$auth -> verify_hub_token($para, $pass);
			}
			$this ->auth_class = $auth;
			
		}

		function verify_entry()
		{
				if($this->auth_class->verify_entry()) { 
					$this->entry_object = $this->auth_class->get_entry_properties();
				}
				return $this->entry_object;
		}

		function initiate_chat($access_token)
		{
			$this->access_token = $access_token;
			$entry_object = $this ->verify_entry();

			$curl_url = curl_init($this->access_token);
			$entry_object->curl_url = $this->access_token;
	        $sender_id = $entry_object ->sender_id;
	        $message = $entry_object->Message;
	        $function_name= strtolower($entry_object->Func_name);
	     
	   		switch($entry_object->Msg_type)
	   		{
	   			case "Message":
	   			$ctl = new \Dev\Message\Message($entry_object);
	   			if($this->auth_class->method_call($ctl, $entry_object))
	   			{
	   					$ctl->$function_name($entry_object->Message);
	   					exit();
	   			}
	   			break;
	   			case "Payload":
	   			$ctl = new \Dev\Payload\Payload($entry_object);
	   			$method_call =  $this->auth_class->method_call($ctl, $entry_object);

	   			if($this->auth_class->method_call($ctl, $entry_object))
	   			{
	   					$ctl->$function_name();
	   					exit();
	   			}
	   			break;
	   			case "Quickpayload":
	   			$ctl = new \Dev\Quick\Quick($entry_object);
	   			$method_call =  $this->auth_class->method_call($ctl, $entry_object);
	   			if($this->auth_class->method_call($ctl, $entry_object))
	   			{
	   					$ctl->$function_name();
	   					exit();
	   			}
	   			break;
	   		}
		}


	}