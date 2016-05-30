<?php

	if (session_id() == '') {
		session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json

	$response = "";

	$post = $_POST['platform'];
	$platform = json_decode($post);

	$id = $platform->id;
	$name = $platform->name;
	
	$proces = updatePlatform($name, $id);
	if ($proces != 0) {
		$response = array("id" => "success");
	} else if ($proces == 0) {
		$response = array("id" => "error");
	}

	function updatePlatform($name, $id) {
		$proces = 0;
		if ($name != "" ) {
			
			$shop = unserialize($_SESSION['shop']);
			$proces = $shop->updatePlatform($name, $id);
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