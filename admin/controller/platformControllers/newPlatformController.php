<?php

	if (session_id() == '') {
		session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json

	$response = "";

	$post = $_POST['platform'];

	$platform = json_decode($post);

	$name = $platform->name;
	
	$proces = addPlatform($name);
	if ($proces != 0) {
		$response = array("id" => "success");
	} else if ($proces == 0) {
		$response = array("id" => "error");
	}

	function addPlatform($name) {
		$proces = 0;
		if ($name != "" ) {
			
			$platform = new Platform($name);
			$proces = $platform->insertPlatform();
			if(!$proces) {
				$proces = 0;
			} else {
				$proces = 1;
			}
		}
		return $proces;
	}

	echo json_encode($response);

?>