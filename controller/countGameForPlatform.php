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
		array_push($platforms_json, json_encode($json));
	}
	

echo json_encode($platforms_json);
	/*$numOrigin = 0;
	$numSteam = 0;
	$numXbox = 0;
	$numPSN = 0;

if ($numGames[0] == "") {
	$numOrigin = 0;
}

if ($numGames[1] == "") {
	$numSteam = 0;
}

if ($numGames[2] == "" OR $numGames[2] == null) {
	$numXbox = 0;
}

if ($numGames[3] == "") {
	$numPSN = 0;
}

	$numOrigin = $numGames[0][0];
	$numSteam = $numGames[1][0];
	$numXbox = $numGames[2][0];
	$numPSN = $numGames[3][0];

	$estadistica = ['numOrigin' => $numOrigin, 'numSteam' => $numSteam, 'numXbox' => $numXbox, 'numPSN' => $numPSN];

	echo json_encode($estadistica);*/

?>