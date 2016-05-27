<?php

	if (session_id() == '') {
		session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json

	$response = "";

	$post = $_POST['genre'];

	$genre = json_decode($post);

	$name = $genre->name;
	
	$proces = addGenre($name);
	if ($proces != 0) {
		$response = array("id" => "success");
	} else if ($proces == 0) {
		$response = array("id" => "error");
	}

	function addGenre($name) {
		$proces = 0;
		if ($name != "" ) {
			
			$genre = new Genre($name);
			$proces = $genre->insertGenre();
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