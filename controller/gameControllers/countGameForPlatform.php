<?php

	session_start();

	require_once("../model/autoload.php");

	$shopDb = unserialize($_SESSION['dbconnection']);

	//
	$platforms = $shopDb->getPlatformNames();

	//Consulta para obtener la cantidad de juegos por plataforma
	$numGames = $shopDb->countGameForPlatform();

	$platforms_json = array();
	$json = null;

	$pos = 0;
	$trobat = false;

	for ($x=0; $x < count($platforms); $x++) {
		$trobat = false; 
		for ($y=0; $y < count($numGames); $y++) {

			if ($platforms[$x][0] == $numGames[$y][0]) {
				$trobat = true;
				$pos = $y;
				$y = count($numGames);
			}			
		}
		if ($trobat == true) {
			$json = array("platform" => $platforms[$x][0], "quantity" => $numGames[$pos][1]);

		} else {
			$json = array("platform" => $platforms[$x][0], "quantity" => 0);

		}
		array_push($platforms_json, $json);
	}


echo json_encode($platforms_json);

?>