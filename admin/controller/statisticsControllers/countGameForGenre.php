<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	$shopDb = unserialize($_SESSION['dbconnection']);

	//Lista de los géneros
	$genres = $shopDb->getGenreNames();

	//Consulta para obtener la cantidad de juegos por género
	$numGames = $shopDb->countGameForGenre();

	$genres_json = array();
	$json = null;

	$pos = 0;
	$trobat = false;

	for ($x=0; $x < count($genres); $x++) {
		$trobat = false; 
		for ($y=0; $y < count($numGames); $y++) {

			if ($genres[$x][0] == $numGames[$y][0]) {
				$trobat = true;
				$pos = $y;
				$y = count($numGames);
			}			
		}
		if ($trobat == true) {
			$json = array("genre" => $genres[$x][0], "quantity" => $numGames[$pos][1]);

		} else {
			$json = array("genre" => $genres[$x][0], "quantity" => 0);

		}
		array_push($genres_json, $json);
	}

echo json_encode($genres_json);

?>