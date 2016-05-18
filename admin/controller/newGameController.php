<?php

require_once("../../model/autoload.php");

if (session_id() == '') {
	session_start();
}

	// Variable de respuesta para json

$response = "";

$post = $_POST['game'];

$game = json_decode($post);




$title = $game->title;
$price = $game->price;
$stock = $game->stock;
$platform = $game->platform;
$proces = addGame($title, $price, $platform);
if ($proces != 0) {
	$response = array("id" => "success");
} else if ($proces == 0) {
	$response = array("id" => "error");
}





function addGame($title, $price, $stock, $plataform) {
	$proces = 0;
	if ($title != "" AND $price != "" AND $stock != "" AND $platform != "" ) {
		
		$game = new Game($title, $price, $platform);
		$proces = $game->insertGame();
	}
	return $proces;
}



echo json_encode($response);

?>