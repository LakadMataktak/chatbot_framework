<?php
	/* Created By Htoo Min Shein */
 	namespace Dev\Auth;
 	use Dev\Response\Response as response;
 	Class Auth
 	{
 		/* validate verify token needed for setting up web hook */ 
		function verify_hub_token($token_response, $pass)
		{
				if($token_response == $pass)
				{
					echo $_GET['hub_challenge'];
					exit();
				} else {
					echo  json_encode(array(
					"error" => 1,
					"msg" => "Wrong Hub Token Call!"
				));
					exit();
				}
		}

		function verify_entry()
		{
				  $input = json_decode(file_get_contents('php://input'), true);
				  if (!isset($input['entry'][0]['messaging'][0]['sender']['id'])) 
				  {
				            echo json_encode(array(
				                "err" => 1,
				                "msg" => "Failed To Get Sender!"
				              )
				            );
				            exit();
				  } 
				  return true;
		}

		function get_entry_properties()
		{
			$input = json_decode(file_get_contents('php://input'), true);
			$sender = $input['entry'][0]['messaging'][0]['sender']['id']; //sender facebook id
		    $message = $input['entry'][0]['messaging'][0]['message']['text']; //text that user sent
		    $message = strtolower($message);
		    $postback_payload = $input['entry'][0]['messaging'][0]['postback']['payload'];
		    $quick_payload = $input['entry'][0]['messaging'][0]['message']['quick_reply']['payload'];
		    if($message && !$quick_payload)
		    {
		    	$msg_type = "Message";
		    	$func_name = $message;
		    }elseif($postback_payload)
		    {
		    	$msg_type = "Payload";
		    	$func_name = $postback_payload;
		    }elseif($quick_payload)
		    {
		    	$msg_type = "Quickpayload";
		    	$func_name = $quick_payload;
		    }

		    $sender_properties = (object)(array(
		    		"sender_id" => $sender,
		    		"Message" => $message,
		    		"Payload"=> $postback_payload,
		    		"Quickpayload" => $quick_payload,
		    		"Msg_type" => $msg_type,
		    		"Func_name" => $func_name,
		    ));
			return $sender_properties;
		}

		function method_call($obj, $entry_object)
		{
				if(!method_exists($obj, $entry_object->Func_name))
	   			{
	   				$response = new response();
	   				$sender_id = $entry_object->sender_id;
					$curl_url = curl_init($entry_object->curl_url);
					$msg = "Method : " . $entry_object->Func_name . " not exists in " . $obj ->type;
	   				$response -> FB_NORMAL_TEXT_MSG($curl_url, $sender_id, $msg);
	   				exit();
	   			}
	   			return true; 
		}


 	}