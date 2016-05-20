<?php

	if (session_id() == '') {
		session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json

	$response = "";

	$post = $_POST['game'];

	$game = json_decode($post);

	$title = $game->title;
	$price = $game->price;
	$platform = $game->platform;
	$proces = addGame($title, $price, $platform);
	if ($proces != 0) {
		$response = array("id" => "success");
	} else if ($proces == 0) {
		$response = array("id" => "error");
	}

	function addGame($title, $price, $platform) {
		$proces = 0;
		if ($title != "" AND $price != ""  AND $platform != "" ) {
			
			$game = new Game($title, $price);
			$game->setPlatform($platform);
			$proces = $game->insertGame();
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