<?php
	namespace Dev\Main;
	use Dev\Auth\Auth as auth;
	use Dev\Response\Response as response;

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
	        $sender_id = $entry_object ->sender_id;
	        $message = $entry_object->message;
	        if($entry_object->Message)
	        {

	        	= Dev\Message\Message("Message")
	        } else if($entry_object->Payload)
	        {

	        }else if($entry_object->Quickpayload)
	        {

	        }else{
	        	exit();
	        }
		//        $response = new response();
		//        if($message == "imyanmar")
		//        {
		 //         $msg = "i know imyanmar";
		 //         $response-> FB_NORMAL_TEXT_MSG($curl_url, $sender_id, $msg);
		// 	 exit();
		// }

		}


	}