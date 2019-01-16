<?php
		error_reporting(E_ERROR);
		require_once("vendor/autoload.php");
		use Dev\Main\Main as Main;
		$hub_token = trim($_GET["hub_verify_token"]);
		$access_token = "EAACRsbm34AMBACpqadWZAzQZAK4ZCasCChtH6CP32gvgtjKuVRYorfvFNVR8dQOe7k8cIKV9NilOp1WZAfWL1OtsXKZBH91n1bFCB3x5rEfGqYmHVbCE4G64cZBpde42YZBTmq2ziobwctvebN3ZCJVGXaiOW2oQOuwnZAf3BFFl7fDCs6yCNCMJ3";
		 $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $access_token;
		 $password = "xenovia";
		$kontol = new Main($hub_token, $password);

		$kontol -> initiate_chat($url);