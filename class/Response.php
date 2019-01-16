<?php
/* Created By Htoo Min Shein */
namespace Dev\Response;
Class Response
{
	function FB_GET_USER_INFO($sender_id, $token)
	{
		 $json = file_get_contents("https://graph.facebook.com/v2.7/" . $sender_id  . "?fields=first_name,last_name,profile_pic,locale,timezone,gender&access_token=" . $token);
		$js =  json_decode($json);
		return $js;
	}

	function FB_NORMAL_TEXT_MSG($curl_url, $sender_id, $msg)
	{
		$jsonData = '
				      {
				  "recipient":{
				    "id":"' . $sender_id . '"
				  },
				  "message":{
				    "text":"' . $msg . '",
				}
				}';
		   curl_setopt($curl_url, CURLOPT_POST, 1);
		   curl_setopt($curl_url, CURLOPT_POSTFIELDS, $jsonData);
		   curl_setopt($curl_url, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		   $result = curl_exec($curl_url); //user will get the message
		return $result;
	}
	function FB_JSON_CONTENT_MSG($curl_url, $sender_id, $json_content)
	{
		$jsonData = '{
	              "recipient":{
	                "id":"' . $sender_id . '"
	              },
	              "message":{
	                "attachment":{
	                  "type":"template",
	                  "payload":{
	                    "template_type":"generic",
	                    "elements":[
	                       ' . $json_content . '
	                    ]}
	                }
	              }
	            }' ;
               curl_setopt($curl_url, CURLOPT_POST, 1);
               curl_setopt($curl_url, CURLOPT_POSTFIELDS, $jsonData);
               curl_setopt($curl_url, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
               $result = curl_exec($curl_url); //user will get the message
               return $result;
	}
	function FB_GENERIC_TEMP_MSG($curl_url, $sender_id, $generics_arr)
	{
		foreach($generics_arr as $key => $generic_arr)
		{
			$title = 		$generic_arr["title"];
			$img_url = 	$generic_arr["image_url"];
			$subtitle = 	$generic_arr["subtitle"];
			$url_1 = 		$generic_arr["url"];
			$btn_title_1 = 	$generic_arr["btn_title_1"];
		
			$payload = 	$generic_arr["payload"];
			$btn_title_2 = 	$generic_arr["btn_title_2"];

		$json_content .= '{
				            "title":"' . $title . '",
				            "image_url": "' . $img_url . '",
				            "subtitle":"' . $subtitle  . '",
				            "default_action": {
				              "type": "web_url",
				              "url": "' . $url_1 . '"
				            },
				            "buttons":[
				              {
				                "type":"web_url",
				                "url":"' . $url_1 . '",
				                "title":"' . $btn_title_1 . '"
				              },{
				                "type":"postback",
				                "title":"' . $btn_title_2 . '",
				                "payload":"' . $payload . '" }              
				            ]},';
		}
 			$json_content = rtrim($json_content, ",");
			  $jsonData = '{
			  "recipient":{
			    "id":"' . $sender_id . '"
			  },
			  "message":{

			    "attachment":{
			      "type":"template",
			      "payload":{
			        "template_type":"generic",
			        
			        "elements":[
			           ' . $json_content . '
			        ]}
			    }
			  },
			}' ;

			   curl_setopt($curl_url, CURLOPT_POST, 1);
			   curl_setopt($curl_url, CURLOPT_POSTFIELDS, $jsonData);
			   curl_setopt($curl_url, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			   $result = curl_exec($curl_url); //user will get the message
			   $generics_arr  = null;
			return $result;
	
	}

	function FB_LIST_TEMP_MSG($curl_url, $sender_id, $generics_arr)
	{

		foreach($generics_arr as $key => $generic_arr)
		{
			$title = 		$generic_arr["title"];
			$img_url = 	$generic_arr["image_url"];
			$subtitle = 	$generic_arr["subtitle"];
			$url_1 = 		$generic_arr["url"];
			$btn_title_1 = 	$generic_arr["btn_title_1"];
		
			$payload = 	$generic_arr["payload"];
			$global_payload = 	$generic_arr["global_payload"];

		$json_content .= '{
			                    "title": "' . $title . '",
			                    "image_url": "' . $img_url . '",
			                    "subtitle": "' . $subtitle .'",
			                    "buttons": [
			                        {
			                            "title": "' . $btn_title_1 . '",
			                            "type": "postback",
			                            "payload": "' . $payload . '"
			                         }
			                    ]
			                },';
		}
 			$json_content = rtrim($json_content, ",");
			  $jsonData = '{
			  "recipient":{
			    "id":"' . $sender_id . '"
			  },
			  "message":{
			    "attachment":{
			      "type":"template",
			      "payload":{
			        "template_type":"list",
			        "elements":[
			           ' . $json_content . '
			        ],
		             "buttons": [
		                {
		                    "title": "View More",
		                    "type": "postback",
		                    "payload": "' . $global_payload . '"                        
		                }
		            ]}
			    }
			  }
			}' ;

			   curl_setopt($curl_url, CURLOPT_POST, 1);
			   curl_setopt($curl_url, CURLOPT_POSTFIELDS, $jsonData);
			   curl_setopt($curl_url, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			   $result = curl_exec($curl_url); //user will get the message
			   $generics_arr  = null;
			return $result;
	
	}

	function FB_GENERIC_NOIMG_MSG($curl_url, $sender_id, $generics_arr)
	{

		foreach($generics_arr as $key => $generic_arr)
		{
			$title = 		$generic_arr["title"];
			$img_url = 	$generic_arr["image_url"];
			$subtitle = 	$generic_arr["subtitle"];
			$url_1 = 		$generic_arr["url"];
			$btn_title_1 = 	$generic_arr["btn_title_1"];
		
			$payload = 	$generic_arr["payload"];
			$btn_title_2 = 	$generic_arr["btn_title_2"];

		$json_content .= '{
				             "title":"' . $title . '",
				       
				            "buttons":[
				              {
				                "type":"web_url",
				                "url":"' . $url_1 . '",
				                "title":"' . $btn_title_1 . '"
				              },{
				                "type":"postback",
				                "title":"' . $btn_title_2 . '",
				                "payload":"' . $payload . '" }       
				            ]},';
		}
 			$json_content = rtrim($json_content, ",");
			  $jsonData = '{
			  "recipient":{
			    "id":"' . $sender_id . '"
			  },
			  "message":{

			    "attachment":{
			      "type":"template",
			      "payload":{
			        "template_type":"generic",
			        
			        "elements":[
			           ' . $json_content . '
			        ]}
			    }
			  },
			}' ;

			   curl_setopt($curl_url, CURLOPT_POST, 1);
			   curl_setopt($curl_url, CURLOPT_POSTFIELDS, $jsonData);
			   curl_setopt($curl_url, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			   $result = curl_exec($curl_url); //user will get the message
			   $generics_arr  = null;
			return $result;
	
	}

	function FB_QUICK_REPLIES_TEMP($curl_url, $sender_id, $quick_reply_title, $quick_replies_arr)
	{
		foreach ($quick_replies_arr as $key => $quick_reply_arr) 
		{
			$title = 		$quick_reply_arr["title"];
			$payload = 	$quick_reply_arr["payload"];
			$img_url =  	$quick_reply_arr["image_url"];
		$json_content .= '
		       {
		          "content_type":"text",
		          "title":"' . $title . '",
		          "payload":"' . $payload . '",
		          "image_url":"' . $img_url . '"
		        },';
		}

		$json_content =  rtrim($json_content, ",");

		$jsonData = '{
		    "recipient":{
		      "id":"' . $sender_id . '"
		    },
		    "message":{
		      "text":"' . $quick_reply_title . '",
		      "quick_replies":[
		       ' . $json_content . '
		      ]
		    }
		  }';
		    curl_setopt($curl_url, CURLOPT_POST, 1);
		   curl_setopt($curl_url, CURLOPT_POSTFIELDS, $jsonData);
		   curl_setopt($curl_url, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		   $result = curl_exec($curl_url); //user will get the message
		   $generics_arr  = null;
		return $result;
	}

}