<?php

	if (session_id() == '') {
		session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json

	$response = "";

	$post = $_POST['offer'];

	$offer = json_decode($post);

	$discount = $offer->discount;
	$game = $offer->game;
	$proces = addOffer($discount, $game);
	if ($proces != 0) {
		$response = array("id" => "success");
	} else if ($proces == 0) {
		$response = array("id" => "error");
	}

	function addOffer($discount, $game) {
		$proces = 0;
		if ($discount != "" AND $game != "") {
			
			$offer = new Offer($discount);
			$offer->setGame($game);
			$proces = $offer->insertOffer();
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