<?php
		error_reporting(E_ERROR);
		require_once("vendor/autoload.php");
		use Dev\Main\Main as Main;
		$hub_token = trim($_GET["hub_verify_token"]);
		$access_token = "";
		 $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $access_token;
		 $password = "xenovia";
		$kontol = new Main($hub_token, $password);

		$kontol -> initiate_chat($url);