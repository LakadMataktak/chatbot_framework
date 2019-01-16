<?php
namespace Dev\Quick;
use Dev\Response\Response as response;
use Dev\Payload\Payload as Payload;
class Quick
{
	public $type = "Type: Quick";
	public $response;
	public $sender_obj;
	function __construct($obj)
	{
		 $this->response = new response();
		 $this->sender_obj = $obj;
	}
	function quick()
	{
				$sender_id = $this->sender_obj->sender_id;
				$curl_url = curl_init($this->sender_obj->curl_url);
		        $msg = "I reach to quick!";
		        $this->response-> FB_NORMAL_TEXT_MSG($curl_url, $sender_id, $msg);

		        $quick_reply_title = "Back to MainMenu!";
		       $quick_replies_arr[0]["title"] = "Main Menu";
		       $quick_replies_arr[0]["payload"] = "payload_mainmenu";
		       $quick_replies_arr[0]["image_url"] = "";
		        $this->response-> FB_QUICK_REPLIES_TEMP($curl_url, $sender_id, $quick_reply_title, $quick_replies_arr);

	}

	function payload_mainmenu()
	{
			$payload = new Payload($this->sender_obj );
			$payload->payload_mainmenu();
	}
}