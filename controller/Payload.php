<?php
namespace Dev\Payload;
use Dev\Response\Response as response;
class Payload
{
	public $type = "Type: Payload";
	public $response;
	public $sender_obj;

	function __construct($obj)
	{
		 $this->response = new response();
		 $this->sender_obj = $obj;
		 var_dump($this->sender_obj);
	}

	function get_started_payload()
	{	
				$sender_id = $this->sender_obj->sender_id;
				$curl_url = curl_init($this->sender_obj->curl_url);
		        $msg = "Welcome to ChatBot! I am here to guide you.";
		        $this->response-> FB_NORMAL_TEXT_MSG($curl_url, $sender_id, $msg);
	}

	function payload_mainmenu()
	{
				$sender_id = $this->sender_obj->sender_id;
				$curl_url = curl_init($this->sender_obj->curl_url);
		        $msg = "I reach to MainMenu!";
		      
		        $this->response-> FB_NORMAL_TEXT_MSG($curl_url, $sender_id, $msg);
		        $quick_reply_title = "Choose the following!";
		       $quick_replies_arr[0]["title"] = "Quck Quck";
		       $quick_replies_arr[0]["payload"] = "quick";
		       $quick_replies_arr[0]["image_url"] = "";
		        $this->response-> FB_QUICK_REPLIES_TEMP($curl_url, $sender_id, $quick_reply_title, $quick_replies_arr);
	}

	function payload_list()
	{
					$sender_id = $this->sender_obj->sender_id;
					$curl_url = curl_init($this->sender_obj->curl_url);
					for($i=1; $i <= 3; $i++)
					{
					$generic_arr["title"] = "Brand List_" . $i;
 					$generic_arr["btn_title_1"] = "View";
					$generic_arr["image_url"] = "https://imhchatbot.serveo.net/images/chd_bank_saving_loan.jpg";
			      	$generic_arr["subtitle"] = "https://imhchatbot.serveo.net";
			      	$generic_arr["payload"] = "FETCH_BRAND__HTOO";
			      	$generic_arr["global_payload"] = "PAYLOAD_BRAND" ;
			      	$generic_arr["payload"] = "FETCH_BRAND___" . $i . "___1";
			      	$generic_arr["global_payload"] = "PAYLOAD_BRAND___" . $i ;
			      	$generic_all[]  = $generic_arr;
			      	}
					$this->response-> FB_LIST_TEMP_MSG($curl_url, $sender_id, $generic_all);
	}

	function payload_grid()
	{
				$sender_id = $this->sender_obj->sender_id;
				$curl_url = curl_init($this->sender_obj->curl_url);
						for($i=1; $i <= 3; $i++)
					{
		  			  $generic_arr["title"] = "Sample Ads " . $i;
			          $generic_arr["image_url"] = "https://imhchatbot.serveo.net/images/chd_bank_saving_loan.jpg";
			          $generic_arr["subtitle"] = "Sample Ads " . $i;
			          $generic_arr["url"] = "https://imhchatbot.serveo.net/images/chd_bank_saving_loan.jpg";
			          $generic_arr["btn_title_1"] = "View Detail";
			          $generic_arr["payload"] = "DEFINE_SYS";
			          $generic_arr["btn_title_2"] = "Start Chatting";
			          $generic_all[]  = $generic_arr;
					}
					$this->response-> FB_GENERIC_TEMP_MSG($curl_url, $sender_id, $generic_all);
	}
}