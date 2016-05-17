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
$plataform = $game->plataform;
$proces = addGame($title, $price, $plataform);
if ($proces != 0) {
	$response = array("id" => "success");
} else if ($proces == 0) {
	$response = array("id" => "error");
}





function addGame($title, $price, $stock, $plataform) {
	$proces = 0;
	if ($title != "" AND $price != "" AND $stock != "" AND $plataform != "" ) {
		
		$game = new Game($title, $price, $plataform);
		$proces = $game->insertGame();
	}
	return $proces;
}



echo json_encode($response);

?>