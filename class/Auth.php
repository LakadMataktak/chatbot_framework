<?php
	/* Created By Htoo Min Shein */
 	namespace Dev\Auth;
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
		    $sender_properties = (object)(array(
		    		"sender_id" => $sender,
		    		"Message" => $message,
		    		"Payload"=> $postback_payload,
		    		"Quickpayload" => $quick_payload
		    ));
			return $sender_properties;
		}

 	}