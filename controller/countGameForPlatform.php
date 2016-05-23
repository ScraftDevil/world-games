<?php

	session_start();

	require_once("../model/autoload.php");

	$shopDb = unserialize($_SESSION['dbconnection']);

	//Consulta para obtener la cantidad de juegos por plataforma
	$result = $shopDb->countGameForPlatform();

	$numOrigin = 0;
	$numSteam = 0;
	$numXbox = 0;
	$numPSN = 0;

if ($result[0] == "") {
	$numOrigin = 0;
}

if ($result[1] == "") {
	$numSteam = 0;
}

if ($result[2] == "" OR $result[2] == null) {
	$numXbox = 0;
}

if ($result[3] == "") {
	$numPSN = 0;
}

	$numOrigin = $result[0][0];
	$numSteam = $result[1][0];
	$numXbox = $result[2][0];
	$numPSN = $result[3][0];

	$estadistica = ['numOrigin' => $numOrigin, 'numSteam' => $numSteam, 'numXbox' => $numXbox, 'numPSN' => $numPSN];

var_dump($estadistica);
	echo json_encode($estadistica);

?>