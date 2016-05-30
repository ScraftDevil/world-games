<?php

	if (session_id() == '') {
		session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json

	$response = "";

	$post = $_POST['genre'];
	$genre = json_decode($post);

	$id = $genre->id;
	$name = $genre->name;
	
	$proces = updateGenre($name, $id);
	if ($proces != 0) {
		$response = array("id" => "success");
	} else if ($proces == 0) {
		$response = array("id" => "error");
	}

	function updateGenre($name, $id) {
		$proces = 0;
		if ($name != "" ) {
			
			$shop = unserialize($_SESSION['shop']);
			$proces = $shop->updateGenre($name, $id);
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