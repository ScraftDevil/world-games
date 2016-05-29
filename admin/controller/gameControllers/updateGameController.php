<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json
	$response = "";

	$post = $_POST['game'];

	$game = json_decode($post);

	$response['status'] = updateGame($game);
	if ($response['status']) {
		$response['status'] = "successUpdate";
	} else {
		$response['status'] = "fail";
	}

	function updateGame($game) {
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->updateGame($game->id, $game->title, $game->price, $game->stock, $game->platform, $game->genres);
		$_SESSION['shop'] = serialize($shop);
		return $proces;
	}

	echo json_encode($response);

?>