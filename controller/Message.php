<?php
namespace Dev\Message;
use Dev\Response\Response as response;
class Message
{
	public $type = "Type: Message";
	public $response;
	public $sender_obj;
	function __construct($obj)
	{
		 $this->response = new response();
		 $this->sender_obj = $obj;
	}
	function imyanmar()
	{
				$sender_id = $this->sender_obj->sender_id;
				$curl_url = curl_init($this->sender_obj->curl_url);
		        $msg = "i know imyanmar";
		        $this->response-> FB_NORMAL_TEXT_MSG($curl_url, $sender_id, $msg);
	}
	
}